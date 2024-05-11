<?php

namespace App\Controllers;

use App\Services\ProductService;
use App\Requests\Request;
use App\Validators\Validator;
use App\Forms\Pagination;
use App\Models\Product;
use App\Services\UserInterestingProductService;

class ProductController extends Controller
{
    /**
     * @var \App\Services\ProductService
     */
    private $productService;

    /**
     * @var \App\Services\UserInterestingProductService
     */
    private $userInterestingProductService;

    /**
     * 建構式
     * 
     * @param \App\Services\ProductService $productService
     * @param \App\Services\UserInterestingProductService $userInterestingProductService
     * 
     * @return void
     */
    public function __construct(ProductService $productService, UserInterestingProductService $userInterestingProductService)
    {
        $this->productService = $productService;
        $this->userInterestingProductService = $userInterestingProductService;
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
        $input = array_map(fn ($value) => sanitizeInput($value), $request->input());
        $input['page'] = $input['page'] ?? 1;
        $page = Validator::errors($input, Pagination::$patterns) === null ? $input['page'] : 1;
        $offset = Product::$rowNumsPerPage * ($page - 1);
        $products = $this->productService->getAllProducts(Product::$rowNumsPerPage, $offset);
        $productRowNums = $this->productService->getProductCount();
        view('product.index', ['products' => $products, 'productRowNums' => $productRowNums, 'totalPageNums' => ceil($productRowNums / Product::$rowNumsPerPage), 'currentPage' => (int) $page]);
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

        // 新增或更新產品被觀看次數
        if ($this->userInterestingProductService->createOrUpdateProductViewedCount($productId) < 1) {
            logToFile('新增或更新產品被觀看次數失敗');
        }

        view('product.show', ['product' => $product]);
    }
}
