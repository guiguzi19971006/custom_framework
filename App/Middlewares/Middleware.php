<?php

namespace App\Middlewares;

use App\Requests\Request;

abstract class Middleware
{
    /**
     * 每個路由都會使用到的 Middlewares
     * 
     * @var array
     */
    public static array $middlewares = [
        'csp' => ResourceOriginAuthentication::class
    ];

    /**
     * 只有特定路由會使用到的 Middlewares
     * 
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
