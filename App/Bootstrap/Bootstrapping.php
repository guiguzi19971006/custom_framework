<?php

namespace App\Bootstrap;

use App\Containers\Container;
use App\Utilities\Route;
use App\Requests\Request;
use App\Traits\Singleton;
use ReflectionClass;
use Exception;
use ReflectionException;

class Bootstrapping
{
    use Singleton;

    /**
     * @var \App\Requests\Request
     */
    private $request;

    /**
     * 建構式
     * 
     * @param \App\Requests\Request $request
     * 
     * @return void
     */
    private function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 處理請求
     * 
     * @return void
     * 
     * @throws \Exception
     */
    public function init()
    {
        [$requestMethod, $requestUrl] = [$this->request->method(), $this->request->url()];
        $projectDirectoryName = substr(strrchr(substr(ROOT_PATH, 0, strlen(ROOT_PATH) - 1), DIRECTORY_SEPARATOR), 1);
        $requestUrl = str_replace(ENTRY_POINT_PATH, '', str_replace('/' . $projectDirectoryName, '', $requestUrl));
        $mappingUrls = array_filter(Route::$routes, function ($route) use ($requestMethod, $requestUrl) {
            return preg_match($route['pattern'], $requestUrl) && $requestMethod === $route['method'];
        });

        if (empty($mappingUrls)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }

        $url = current($mappingUrls);

        if (count($url['action']) < 2) {
            throw new Exception('Route must provide controller and method');
        }

        preg_match($url['pattern'], $requestUrl, $params);
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
