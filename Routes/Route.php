<?php

namespace Routes;

use App\Requests\Request;

class Route
{
    /**
     * @var array
     */
    public static array $routes = [];

    /**
     * @var self|null
     */
    private static ?self $instance = null;

    /**
     * 建構式
     * 
     * @return void
     */
    private function __construct()
    {
        
    }

    /**
     * 建立 \Routes\Route 的類別實體物件
     * 
     * @return static
     */
    private static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Request HTTP method: GET
     * @param string $url
     * @param array $action
     * @return static
     */
    public static function get(string $url, array $action): static
    {
        static::$routes[] = [
            'method' => Request::GET, 
            'url' => $url, 
            'pattern' => '/^' . preg_replace(['/{[A-Za-z_]+}/', '/\//'], ['([0-9]+)', '\/'], $url) . '$/', 
            'action' => $action
        ];

        return static::getInstance();
    }
}
