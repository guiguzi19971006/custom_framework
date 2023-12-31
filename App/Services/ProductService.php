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
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * 取得所有產品
     * 
     * @return array
     */
    public function getAllProducts(): array
    {
        return $this->productRepository->getAllProducts();
    }
}
