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
        } else {
            $statement = <<< 'SQL_STATEMENT'
                select
                    count(*) as `row_nums`
                from `product`
            SQL_STATEMENT;
        }

        $product = DB::query($statement)->get(true);
        return $product['row_nums'];
    }

    /**
     * 取得被觀看次數由多至少排序的前 n 項熱門產品
     * 
     * @param int $limit
     * 
     * @return array|null
     */
    public function getTheHottestProducts(int $limit)
    {
        $statement = <<< SQL_STATEMENT
            select
                `t1`.`id` as `product_id`,
                `t1`.`name` as `product_name`,
                `t1`.`price` as `product_price`,
                `t1`.`photo` as `product_photo`,
                `t1`.`description` as `product_description`
            from `product` as `t1`
            inner join (
                select
                    `product_id`,
                    count(*) as `product_viewed_count`
                from `user_interesting_product`
                group by `product_id`
            ) as `t2`
            on `t1`.`id` = `t2`.`product_id`
            where `t1`.`deleted_at` is null
            order by
                `t2`.`product_viewed_count` desc,
                `t1`.`id` asc
            limit $limit
        SQL_STATEMENT;
        return DB::query($statement)->get();
    }
}
