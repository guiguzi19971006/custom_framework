<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Mailer\Mail;
use App\Containers\Container;

class UserService
{
    /**
     * @var \App\Repositories\UserRepository
     */
    private $userRepository;

    /**
     * 建構式
     * 
     * @param \App\Repositories\UserRepository
     * 
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $currentTimestamp = time();

        // 檢查使用者是否年滿 18 歲
        if (($currentTimestamp - strtotime($user['birthday'])) < ($currentTimestamp - strtotime('-18 years'))) {
            return ['code' => '001', 'message' => '須年滿 18 歲才可註冊帳號'];
        }

        // 檢查是否重複註冊使用者
        if ($this->userRepository->getUserDataByEmailOrPhone($user['email'], $user['phone']) !== null) {
            return ['code' => '002', 'message' => '電子郵件或手機號碼已存在'];
        }

        // 註冊使用者
        if ($this->userRepository->createUser($user) < 1) {
            return ['code' => '003', 'message' => '註冊失敗'];
        }

        // 發送電子郵件給使用者以通知註冊成功
        if (!Container::resolve(Mail::class)->send('註冊成功', view('email.user.registration_successfully', ['name' => $user['name']], true), [$user['email']])) {
            logToFile('發送使用者註冊成功通知信件失敗');
        }

        logToFile('註冊使用者成功');
        return ['code' => '000', 'message' => '註冊成功'];
    }
}
