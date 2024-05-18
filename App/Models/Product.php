<?php

namespace App\Models;

class Product extends Model
{
    /**
     * 每個頁面的資料列數
     * 
     * @var int
     */
    public static int $rowNumsPerPage = 3;
}
