<?php

namespace App\Forms;

class Pagination
{
    /**
     * 資料格式
     * 
     * @var array
     */
    public static array $patterns = [
        'page' => '/^([0-9]+)$/'
    ];

    /**
     * 錯誤訊息
     * 
     * @var array
     */
    public static array $errors = [
        'page' => '分頁頁數格式錯誤'
    ];
}
