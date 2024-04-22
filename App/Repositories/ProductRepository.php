<?php

namespace App\Repositories;

use Database\DB;

class ProductRepository
{
    /**
     * 取得所有產品
     * 
     * @return array|null
     */
    public function getAllProducts()
    {
        $statement = 'select * from `product` order by `updated_at` desc';
        return DB::query($statement)->get();
    }

    /**
     * 取得單一產品
     * 
     * @param string $productId
     * 
     * @return array|null
     */
    public function getProduct(string $productId)
    {
        $statement = 'select * from `product` where `id` = ? limit 1';
        return DB::query($statement, [$productId])->get(true);
    }
}
