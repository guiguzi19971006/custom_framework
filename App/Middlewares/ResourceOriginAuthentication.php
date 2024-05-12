<?php

namespace App\Middlewares;

use App\Requests\Request;
use App\Constants\Http\Method;

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
        if ($request->method() !== Method::GET) {
            return;
        }

        header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'");
    }
}
