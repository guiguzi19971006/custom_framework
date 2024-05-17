<?php

namespace App\Controllers;

use App\Requests\Request;
use App\Services\ProductService;

class HomeController extends Controller
{
    /**
     * 首頁各區塊欲顯示的項目數量
     * 
     * @var int
     */
    private static int $itemCount = 3;

    /**
     * @var \App\Services\ProductService
     */
    private $productService;

    /**
     * 建構式
     * 
     * @param \App\Services\ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * 首頁
     * 
     * @param \App\Requests\Request $request
     * 
     * @return void
     */
    public function index(Request $request)
    {
        $theHottestProducts = $this->productService->getTheHottestProducts(static::$itemCount);
        view('home.index', ['theHottestProducts' => $theHottestProducts]);
    }
}
