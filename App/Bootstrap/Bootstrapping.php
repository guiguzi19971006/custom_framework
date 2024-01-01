<?php

namespace App\Bootstrap;

use App\Providers\Provider;
use Routes\Route;
use Exception;
use ReflectionClass;

class Bootstrapping
{
    /**
     * 處理請求
     * 
     * @return void
     * @throws \Exception
     */
    public static function init(): void
    {
        $currentUrl = str_replace('/index.php', '', strpos($_SERVER['REQUEST_URI'], '?') === false ? $_SERVER['REQUEST_URI'] : strstr($_SERVER['REQUEST_URI'], '?', true));
        $mappingUrls = array_filter(Route::$routes, function ($route) use ($currentUrl) {
            return (bool) preg_match($route['pattern'], $currentUrl);
        });

        if (empty($mappingUrls)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $url = current($mappingUrls);

        if (!isset($url['action']['controller'], $url['action']['method'])) {
            throw new Exception('Route must provide controller and method.');
        }

        preg_match($url['pattern'], $currentUrl, $params);
        
        try {
            call_user_func_array([Provider::getInstance(new ReflectionClass($url['action']['controller'])), $url['action']['method']], array_slice($params, 1));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
