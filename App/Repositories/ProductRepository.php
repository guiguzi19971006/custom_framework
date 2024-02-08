<?php

namespace App\Repositories;

class ProductRepository
{
    /**
     * 取得所有產品
     * 
     * @return array
     */
    public function getAllProducts()
    {
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
    }
}
