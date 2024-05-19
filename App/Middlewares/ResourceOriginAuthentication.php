<?php

namespace App\Middlewares;

use App\Requests\Request;

class ResourceOriginAuthentication extends Middleware
{
    /**
     * 處理請求
     * 
     * @param \App\Requests\Request $request
     * 
     * @return mixed
     */
    public static function handle(Request $request)
    {
        header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:");
    }
}
