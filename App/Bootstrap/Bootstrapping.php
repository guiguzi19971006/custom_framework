<?php

namespace App\Bootstrap;

use App\Providers\Provider;
use Routes\Route;
use Exception;

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
        $currentUrl = str_replace('/index.php', '', strpos($_SERVER['REQUEST_URI'], '?') === false ? $_SERVER['REQUEST_URI'] : strstr($_SERVER['REQUEST_URI'], '?', true));
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

        $url['action'] = array_values($url['action']);
        preg_match($url['pattern'], $currentUrl, $params);
        call_user_func_array([Provider::getInstance($url['action'][0]), $url['action'][1]], array_slice($params, 1));
    }
}
