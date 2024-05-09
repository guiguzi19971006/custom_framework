<?php

namespace App\Repositories;

use App\Supports\DB;

class UserInterestingProductRepository
{
    /**
     * 新增或更新產品被觀看次數
     * 
     * @param int $productId
     * @param int|null $userId
     * 
     * @return int
     */
    public function createOrUpdateProductViewsCount(int $productId, ?int $userId = null)
    {
        $statement = <<< 'SQL_STATEMENT'
            select
                sum(`views_count`) as `views_count`,
                count(*) as `row_nums`
            from `user_interesting_product`
            where `product_id` = ?
        SQL_STATEMENT;
        $userInterestingProduct = DB::query($statement, [$productId])->get(true);

        if ($userInterestingProduct['row_nums'] < 1) {
            $statement = <<< 'SQL_STATEMENT'
                insert into `user_interesting_product` (`user_id`, `product_id`, `views_count`)
                values (?, ?, ?)
            SQL_STATEMENT;
            return DB::query($statement, [$userId, $productId, 1])->affectedRowNums();
        }

        $statement = <<< 'SQL_STATEMENT'
            update `user_interesting_product`
            set `views_count` = ?
            where `product_id` = ?
        SQL_STATEMENT;
        return DB::query($statement, [$userInterestingProduct['views_count'] + 1, $productId])->affectedRowNums();
    }
}
