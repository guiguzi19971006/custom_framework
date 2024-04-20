<?php

namespace App\Bootstrap;

use App\Containers\Container;
use Routes\Route;
use ReflectionClass;
use Exception;
use ReflectionException;

class Bootstrapping
{
    /**
     * 處理請求
     * 
     * @return void
     * 
     * @throws \Exception
     */
    public static function init()
    {
        $currentUrl = str_replace((strpos($_SERVER['REQUEST_URI'], '/' . PROJECT_NAME) === false ? '' : '/' . PROJECT_NAME) . '/public/index.php', '', strpos($_SERVER['REQUEST_URI'], '?') === false ? $_SERVER['REQUEST_URI'] : strstr($_SERVER['REQUEST_URI'], '?', true));
        $mappingUrls = array_filter(Route::$routes, function ($route) use ($currentUrl) {
            return (bool) preg_match($route['pattern'], $currentUrl);
        });

        if (empty($mappingUrls)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $url = current($mappingUrls);

        if (count($url['action']) < 2) {
            throw new Exception('Route must provide controller and method');
        }

        preg_match($url['pattern'], $currentUrl, $params);
        call_user_func_array([Container::resolve($url['action'][0]), $url['action'][1]], array_slice($params, 1));
    }

    /**
     * 註冊服務
     * 
     * @param array $providers
     * 
     * @return void
     * 
     * @throws \Exception
     * @throws \ReflectionException
     */
    public static function registerServices(array $providers)
    {
        foreach ($providers as $provider) {
            try {
                $classReflector = new ReflectionClass($provider);
            } catch (ReflectionException $e) {
                throw $e;
            }
        
            if (!$classReflector->hasMethod('register') || !$classReflector->getMethod('register')->isStatic()) {
                throw new Exception("$provider::register() does not exist");
            }
        
            $provider::register();
        }
    }
}
