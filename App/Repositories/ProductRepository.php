<?php

namespace App\Repositories;

use Exception;

class ProductRepository
{
    /**
     * 取得所有產品
     * 
     * @return array
     * @throws \Exception
     */
    public function getAllProducts(): array
    {
        try {
            $products = [
                [
                    'id' => 1,
                    'name' => '商品一',
                    'price' => 990
                ],
                [
                    'id' => 2,
                    'name' => '商品二',
                    'price' => 1490
                ],
                [
                    'id' => 3,
                    'name' => '商品三',
                    'price' => 1990
                ]
            ];
    
            return $products;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
