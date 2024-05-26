<?php

namespace App\Controllers;

use App\Requests\Request;
use App\Services\UserService;
use App\Validators\Validator;
use App\Forms\User;

class UserController extends Controller
{
    /**
     * @var \App\Services\UserService
     */
    private $userService;

    /**
     * 建構式
     * 
     * @param \App\Services\UserService $userService
     * 
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 會員註冊頁面
     * 
     * @param \App\Requests\Request $request
     * 
     * @return void
     */
    public function register(Request $request)
    {
        view('user.register');
    }

    /**
     * 會員註冊
     * 
     * @param \App\Requests\Request $request
     * 
     * @return void
     */
    public function registerProcess(Request $request)
    {
        $input = array_map(fn ($value) => sanitizeInput($value), $request->input());
        $input = [
            'email' => $input['email'] ?? '',
            'password' => $input['password'] ?? '',
            'name' => $input['name'] ?? '',
            'gender' => $input['gender'] ?? '',
            'birthday' => $input['birthday'] ?? '',
            'phone' => $input['phone'] ?? '',
            'address' => $input['address'] ?? ''
        ];
        $errors = Validator::errors($input, User::$patterns, User::$errors);
        
        if ($errors !== null) {
            $response = json_encode(['code' => '400', 'message' => '資料格式錯誤', 'errors' => $errors]);
        } else {
            $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
            $response = json_encode($this->userService->registerUser($input));
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo $response;
    }
}
