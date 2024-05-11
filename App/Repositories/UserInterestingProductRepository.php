<?php

namespace App\Repositories;

use App\Supports\DB;

class UserInterestingProductRepository
{
    /**
     * 新增產品被觀看次數
     * 
     * @param int $productId
     * @param int|null $userId
     * 
     * @return int
     */
    public function createProductViewedCount(int $productId, ?int $userId = null)
    {
        $statement = <<< 'SQL_STATEMENT'
            insert into `user_interesting_product` (`user_id`, `product_id`) values
            (?, ?)
        SQL_STATEMENT;
        return DB::query($statement, [$userId ?? null, $productId])->affectedRowNums();
    }
}
