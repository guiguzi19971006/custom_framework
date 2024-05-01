<?php

namespace App\Controllers;

use App\Services\ProductService;
use App\Requests\Request;

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
     * @param \App\Requests\Request $request
     * 
     * @return void
     */
    public function index(Request $request)
    {
        $products = $this->productService->getAllProducts();
        view('product.index', ['products' => $products]);
    }

    /**
     * 單一商品頁
     * 
     * @param string $productId
     * @param \App\Requests\Request $request
     * 
     * @return void
     */
    public function show(string $productId, Request $request)
    {
        $product = $this->productService->getProduct($productId);

        if ($product === null) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        view('product.show', ['product' => $product]);
    }
}
