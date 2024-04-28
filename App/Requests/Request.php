<?php

namespace App\Requests;

use App\Traits\Singleton;
use Exception;

class Request
{
    use Singleton;

    /**
     * 建構式
     * 
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * 取得 Request HTTP Method
     * 
     * @return string
     * 
     * @throws \Exception
     */
    public function method()
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            throw new Exception('Cannot get request HTTP method');
        }

        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * 取得 Request URL
     * 
     * @return string
     * 
     * @throws \Exception
     */
    public function url()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            throw new Exception('Cannot get request URL');
        }

        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
