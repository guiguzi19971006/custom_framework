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
        $statement = <<< 'SQL_STATEMENT'
            select
                `product`.*,
                `product_category`.`name` as `product_category_name`
            from `product`
            inner join `product_category`
            on `product`.`product_category_id` = `product_category`.`id`
            where `product`.`id` = ?
            limit 1
        SQL_STATEMENT;
        return DB::query($statement, [$productId])->get(true);
    }
}
