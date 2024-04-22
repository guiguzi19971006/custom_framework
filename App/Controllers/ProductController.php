<?php

namespace App\Controllers;

use App\Services\ProductService;

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
     * 
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
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();
        view('product.index', ['products' => $products]);
    }

    /**
     * 單一商品頁
     * 
     * @param string $productId
     * 
     * @return void
     */
    public function show(string $productId)
    {
        $product = $this->productService->getProduct($productId);

        if ($product === null) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        view('product.show', ['product' => $product]);
    }
}
