<?php

namespace App\Bootstrap;

use App\Containers\Container;
use App\Requests\Request;
use App\Traits\Singleton;
use App\Middlewares\Middleware;
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
        // 取得路由資訊
        $route = $this->request->handle();

        // 透過 Middleware 過濾請求
        $middlewares = isset($route['middlewares']) && is_array($route['middlewares']) ? array_merge(array_keys(Middleware::$middlewares), $route['middlewares']) : array_keys(Middleware::$middlewares);
        $this->filterRequest(array_unique($middlewares));

        // 處理請求
        preg_match($route['pattern'], $route['url'], $params);
        call_user_func_array([Container::resolve($route['actions'][0]), $route['actions'][1]], array_merge(array_slice($params, 1), [$this->request]));
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

    /**
     * 透過 Middlewares 過濾請求
     * 
     * @param array $middlewares
     * 
     * @return void
     * 
     * @throws \Exception
     * @throws \ReflectionException
     */
    private function filterRequest(array $middlewares)
    {
        foreach ($middlewares as $middleware) {
            if (!(isset(Middleware::$middlewares[$middleware]) xor isset(Middleware::$routeMiddlewares[$middleware]))) {
                throw new Exception("The key '$middleware' must exactly exist in " . Middleware::class . '::$middlewares or ' . Middleware::class . '::$routeMiddlewares and cannot exist both or neither exist');
            }

            $middleware = Middleware::$middlewares[$middleware] ?? Middleware::$routeMiddlewares[$middleware];

            try {
                $classReflector = new ReflectionClass($middleware);
            } catch (ReflectionException $e) {
                throw $e;
            }

            if (!$classReflector->hasMethod('handle') || !$classReflector->getMethod('handle')->isStatic()) {
                throw new Exception("Call to undefined method $middleware::handle()");
            }

            $middleware::handle($this->request);
        }
    }
}
