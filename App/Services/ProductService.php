<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\UserInterestingProductRepository;

class ProductService
{
    /**
     * @var \App\Repositories\ProductRepository
     */
    private $productRepository;

    /**
     * @var \App\Repositories\UserInterestingProductRepository
     */
    private $userInterestingProductRepository;

    /**
     * 建構式
     * 
     * @param \App\Repositories\ProductRepository $productRepository
     * @param \App\Repositories\UserInterestingProductRepository $userInterestingProductRepository
     * 
     * @return void
     */
    public function __construct(ProductRepository $productRepository, UserInterestingProductRepository $userInterestingProductRepository)
    {
        $this->productRepository = $productRepository;
        $this->userInterestingProductRepository = $userInterestingProductRepository;
    }

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
        return $this->productRepository->getAllProducts($perPageRowNums, $offset);
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
        return $this->productRepository->getProduct($productId);
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
        return $this->productRepository->getProductCount($isOnlyGettingUndeleted);
    }

    /**
     * 取得被觀看次數由多至少排序的前三分之一項熱門產品
     * 
     * @param int|null $limit
     * 
     * @return array|null
     */
    public function getTheHottestProducts(?int $limit = null)
    {
        if ($limit === null) {
            $productRowNums = $this->getProductCount();
            $limit = round($productRowNums / 3);
        }
        
        return $this->productRepository->getTheHottestProducts($limit);
    }

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
        return $this->userInterestingProductRepository->createProductViewedCount($productId, $userId);
    }
}
