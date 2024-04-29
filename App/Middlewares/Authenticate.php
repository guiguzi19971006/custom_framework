<?php

namespace App\Middlewares;

use App\Requests\Request;

class Authenticate extends Middleware
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
        if ($request->headers('Authorization') === false) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}
