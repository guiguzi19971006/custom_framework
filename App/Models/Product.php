<?php

namespace App\Models;

class Product extends Model
{
    /**
     * 資料表名稱
     * 
     * @var string
     */
    private string $table = 'product';

    /**
     * 建構式
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
