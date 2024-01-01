<?php

namespace App\Controllers;

use App\Services\ProductService;
use Exception;

class ProductController extends Controller
{
    /**
     * @var \App\Services\ProductService
     */
    private $productService;

    /**
     * 建構式
     * 
     * @param \App\Services\ProductService $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * 所有商品頁
     * 
     * @return void
     * @throws \Exception
     */
    public function index(): void
    {
        try {
            $products = $this->productService->getAllProducts();
            view('product.index', ['products' => $products]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 單一商品頁
     * 
     * @param string $productId
     * @return void
     * @throws \Exception
     */
    public function show(string $productId): void
    {
        try {
            view('product.show', ['productId' => $productId]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
