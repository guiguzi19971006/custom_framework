<?php

namespace App\Utilities;

use App\Traits\Singleton;
use App\Constants\Http\Method;
use App\Supports\Route as RouteSupport;
use ReflectionClass;
use ReflectionMethod;
use ReflectionException;
use Exception;

class Route extends Utility
{
    use Singleton;

    /**
     * @var array
     */
    public static array $routes = [];

    /**
     * @var string|null
     */
    private ?string $url = null;

    /**
     * @var string|null
     */
    private ?string $method = null;


    /**
     * @var array|null
     */
    private ?array $middlewares = null;

    /**
     * 建構式
     * 
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * 註冊路由
     * 
     * @param string $url
     * @param array $actions
     * @param string $method
     * 
     * @return static
     * 
     * @throws \Exception
     */
    private function register(string $url, array $actions, string $method = Method::GET)
    {
        if (count($actions) < 2) {
            throw new Exception('Route must provide controller and method');
        }

        $this->url = $url;
        $this->method = $method;
        static::$routes[] = [
            'url' => $url,
            'method' => $method,
            'pattern' => '/^' . preg_replace(['/{[A-Za-z_]+}/', '/\//'], ['([A-Za-z0-9\-]+)', '\/'], $url) . '$/',
            'actions' => array_values($actions),
            'middlewares' => $this->middlewares
        ];
        return $this;
    }

    /**
     * 定義路由所需的 Middlewares
     * 
     * @param array $middlewares
     * 
     * @return static
     */
    public function middleware(array $middlewares)
    {
        $this->middlewares = array_values($middlewares);
        $routes = array_filter(static::$routes, function ($route) {
            return $route['url'] === $this->url && $route['method'] === $this->method;
        });

        if (!empty($routes)) {
            static::$routes[key($routes)]['middlewares'] = $this->middlewares;
        }

        return $this;
    }

    /**
     * 清除屬性
     * 
     * @return void
     */
    public function clear()
    {
        $this->url = $this->method = $this->middlewares = null;
    }

    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return static
     * 
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function __call(string $name, array $arguments)
    {
        try {
            $classReflector = new ReflectionClass(Method::class);
        } catch (ReflectionException $e) {
            throw $e;
        }

        $httpMethod = strtoupper($name);

        if (!$classReflector->hasConstant($httpMethod)) {
            throw new Exception("Call to undefined method " . RouteSupport::class . "::$name()");
        }

        try {
            $methodReflector = new ReflectionMethod($this, 'register');
        } catch (ReflectionException $e) {
            throw $e;
        }

        if (count($arguments) < $methodReflector->getNumberOfRequiredParameters()) {
            throw new Exception("Must provide at least two parameters for registering routes");
        }

        foreach ($methodReflector->getParameters() as $i => $parameter) {
            if (!isset($arguments[$i])) {
                break;
            }

            if (gettype($arguments[$i]) !== $parameter->getType()->getName()) {
                throw new Exception("Provide parameters' types must correspond the method of routing");
            }
        }

        return $this->register(...array_merge($arguments, [$httpMethod]));
    }
}
