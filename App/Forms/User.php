<?php

namespace App\Forms;

class User
{
    /**
     * 資料格式
     * 
     * @var array
     */
    public static array $patterns = [
        'email' => 'email',
        'password' => '/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/',
        'name' => '/^[\sa-zA-Z\x{4E00}-\x{9FFF}]{2,50}$/u',
        'gender' => '/^(M|F){1}$/',
        'birthday' => '/^(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/',
        'phone' => '/^09[0-9]{8}$/'
    ];

    /**
     * 錯誤訊息
     * 
     * @var array
     */
    public static array $errors = [
        'email' => '電子郵件格式錯誤',
        'password' => '密碼長度須為至少八個字元，且須至少包含一個特殊字元和英數字',
        'name' => '姓名可包含中英文與空白字元，長度至少兩個字元，至多五十個字元',
        'gender' => '性別格式錯誤',
        'birthday' => '生日格式錯誤',
        'phone' => '手機號碼格式錯誤'
    ];
}
