<?php

namespace App\Containers;

class Container
{
    /**
     * @var array
     */
    public static array $bindings = [
        'services' => [
            \App\Services\ProductService::class
        ],

        'repositories' => [
            \App\Repositories\ProductRepository::class
        ]
    ];
}
