<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserRegistrationTokenRepository;
use App\Mailer\Mail;
use App\Containers\Container;
use App\Supports\DB;
use App\Models\User;

class UserService
{
    /**
     * @var \App\Repositories\UserRepository
     */
    private $userRepository;

    /**
     * @var \App\Repositories\UserRegistrationTokenRepository
     */
    private $userRegistrationTokenRepository;

    /**
     * 建構式
     * 
     * @param \App\Repositories\UserRepository $userRepository
     * @param \App\Repositories\UserRegistrationTokenRepository $userRegistrationTokenRepository
     * 
     * @return void
     */
    public function __construct(UserRepository $userRepository, UserRegistrationTokenRepository $userRegistrationTokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->userRegistrationTokenRepository = $userRegistrationTokenRepository;
    }

    /**
     * 註冊使用者
     * 
     * @param array $user
     * 
     * @return array
     */
    public function registerUser(array $user)
    {
        // 檢查使用者是否年滿 18 歲
        if (strtotime($user['birthday']) > strtotime('-18 years')) {
            return ['code' => '001', 'message' => '須年滿 18 歲才可註冊帳號'];
        }

        // 檢查是否重複註冊使用者
        if ($this->userRepository->getUserDataByEmailOrPhone($user['email'], $user['phone']) !== null) {
            return ['code' => '002', 'message' => '電子郵件或手機號碼已存在'];
        }

        DB::query('start transaction');

        // 註冊使用者
        $userId = $this->userRepository->createUser(array_merge($user, ['registration_time' => date('Y-m-d H:i:s')]));

        // 產生使用者註冊 token
        $userRegistrationTokenId = $this->userRegistrationTokenRepository->createUserRegistrationToken([$userId, $token = randomStr(), date('Y-m-d H:i:s', strtotime('+15 mins'))]);
        
        if ($userId === null || $userRegistrationTokenId === null) {
            DB::query('rollback');
            return ['code' => '003', 'message' => '註冊失敗'];
        }

        DB::query('commit');

        // 發送電子郵件給使用者以通知註冊成功
        if (!Container::resolve(Mail::class)->send(env('PROJECT_NAME') . ' - 會員註冊成功', view('email.user.registration_successfully', ['name' => $user['name'], 'token' => $token], true), [$user['email']])) {
            logToFile('發送使用者註冊成功通知信件失敗');
        }

        logToFile('註冊使用者成功');
        return ['code' => '000', 'message' => '註冊成功'];
    }

    /**
     * 啟用使用者
     * 
     * @param string $token
     * 
     * @return array|null
     */
    public function activateTheUser(string $token)
    {
        return $this->userRegistrationTokenRepository->getTheValidUserRegistrationTokenByTokenContent($token, date('Y-m-d H:i:s'));
    }

    /**
     * 透過使用者編號更新使用者帳號啟用狀態
     * 
     * @param int $userId
     * 
     * @return int
     */
    public function updateUserActivationStatusByUserId(int $userId)
    {
        return $this->userRepository->updateUserActivationStatusByUserId(User::$activated, $userId);
    }
}
