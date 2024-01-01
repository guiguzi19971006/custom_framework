<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;

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
     * @throws \Exception
     */
    public function getAllProducts(): array
    {
        try {
            return $this->productRepository->getAllProducts();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
