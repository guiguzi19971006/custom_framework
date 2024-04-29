<?php

namespace App\Middlewares;

use App\Requests\Request;

abstract class Middleware
{
    /**
     * @var array
     */
    public static array $routeMiddlewares = [
        'auth' => Authenticate::class
    ];

    /**
     * 處理請求
     * 
     * @param \App\Requests\Request $request
     * 
     * @return mixed
     */
    abstract public static function handle(Request $request);
}
