<?php

namespace App\Repositories;

use App\Supports\DB;

class ProductRepository
{
    /**
     * 取得所有產品
     * 
     * @param int $perPageRowNums
     * @param int $offset
     * 
     * @return array|null
     */
    public function getAllProducts(int $perPageRowNums, int $offset = 0)
    {
        $statement = <<< SQL_STATEMENT
            select * from `product`
            order by `updated_at` desc
            limit $perPageRowNums
            offset $offset
        SQL_STATEMENT;
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

    /**
     * 取得產品總數量
     * 
     * @param bool $isOnlyGettingUndeleted
     * 
     * @return int
     */
    public function getProductCount(bool $isOnlyGettingUndeleted = true)
    {
        if ($isOnlyGettingUndeleted) {
            $statement = <<< 'SQL_STATEMENT'
                select
                    count(*) as `row_nums`
                from `product`
                where `deleted_at` is null
            SQL_STATEMENT;
            $product = DB::query($statement)->get(true);
            return $product['row_nums'];
        }

        $statement = <<< 'SQL_STATEMENT'
            select
                count(*) as `row_nums`
            from `product`
        SQL_STATEMENT;
        $product = DB::query($statement)->get(true);
        return $product['row_nums'];
    }
}
