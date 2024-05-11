<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    /**
     * @var \App\Repositories\ProductRepository
     */
    private $productRepository;

    /**
     * 建構式
     * 
     * @param \App\Repositories\ProductRepository $productRepository
     * 
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
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
        return $this->productRepository->getProductCount();
    }
}
