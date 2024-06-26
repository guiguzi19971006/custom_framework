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
        $bearerAccessToken = $request->headers('Authorization');
        $isUnauthorized = $bearerAccessToken === null || strpos($bearerAccessToken, 'Bearer ') === false || jwtDecode(substr($bearerAccessToken, strlen('Bearer ')), env('JWT_SECRET')) === false;

        if ($isUnauthorized) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}
