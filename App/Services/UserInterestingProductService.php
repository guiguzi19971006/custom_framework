<?php

namespace App\Services;

use App\Repositories\UserInterestingProductRepository;

class UserInterestingProductService
{
    /**
     * @var \App\Repositories\UserInterestingProductRepository
     */
    private $userInterestingProductRepository;

    /**
     * 建構式
     * 
     * @param \App\Repositories\UserInterestingProductRepository $userInterestingProductRepository
     * 
     * @return void
     */
    public function __construct(UserInterestingProductRepository $userInterestingProductRepository)
    {
        $this->userInterestingProductRepository = $userInterestingProductRepository;
    }

    /**
     * 新增或更新產品被觀看次數
     * 
     * @param int $productId
     * @param int|null $userId
     * 
     * @return int
     */
    public function createOrUpdateProductViewedCount(int $productId, ?int $userId = null)
    {
        return $this->userInterestingProductRepository->createOrUpdateProductViewedCount($productId, $userId);
    }
}
