<?php

namespace App\Repositories;

use Database\DB;

class ProductRepository
{
    /**
     * 取得所有產品
     * 
     * @return array
     */
    public function getAllProducts()
    {
        $query = 'select * from `product`';
        return DB::getInstance()->query($query)->get();
    }
}
