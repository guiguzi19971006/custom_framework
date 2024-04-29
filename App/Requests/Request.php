<?php

namespace App\Requests;

use App\Traits\Singleton;
use App\Utilities\Route;
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
            throw new Exception('Cannot get the request HTTP method');
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
            throw new Exception('Cannot get the request URL');
        }

        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * 取得 Request headers
     * 
     * @param string|null $name
     * 
     * @return mixed
     * 
     * @throws \Exception
     */
    public function headers(?string $name = null)
    {
        $headers = getallheaders();

        if ($headers === false) {
            throw new Exception('Cannot get request HTTP headers');
        }

        if ($name === null) {
            return $headers;
        }

        if (!isset($headers[$name])) {
            return false;
        }

        return $headers[$name];
    }

    /**
     * 處理請求
     * 
     * @return array
     */
    public function handle()
    {
        [$requestMethod, $requestUrl] = [$this->method(), $this->url()];
        $projectDirectoryName = substr(strrchr(substr(ROOT_PATH, 0, strlen(ROOT_PATH) - 1), DIRECTORY_SEPARATOR), 1);
        $requestUrl = str_replace(ENTRY_POINT_PATH, '', str_replace('/' . $projectDirectoryName, '', $requestUrl));
        $mappingUrls = array_filter(Route::$routes, function ($route) use ($requestMethod, $requestUrl) {
            return preg_match($route['pattern'], $requestUrl) && $route['method'] === $requestMethod;
        });

        if (empty($mappingUrls)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        return array_merge(current($mappingUrls), ['url' => $requestUrl]);
    }
}
