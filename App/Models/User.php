<?php

namespace App\Models;

class User extends Model
{
    /**
     * 使用者帳號未啟用狀態
     * 
     * @var int
     */
    public static int $inactivated = 0;

    /**
     * 使用者帳號已啟用狀態
     * 
     * @var int
     */
    public static int $activated = 1;
}
