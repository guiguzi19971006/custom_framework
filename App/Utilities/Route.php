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
     * @param array $action
     * @param string|null $method
     * 
     * @return static
     * 
     * @throws \Exception
     */
    private function register(string $url, array $action, ?string $method = null)
    {
        if (count($action) < 2) {
            throw new Exception('Route must provide controller and method');
        }

        $this->url = $url;
        static::$routes[$this->url] = [
            'method' => $method,
            'pattern' => '/^' . preg_replace(['/{[A-Za-z_]+}/', '/\//'], ['([0-9]+)', '\/'], $url) . '$/',
            'action' => array_values($action),
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

        if (isset($this->url, static::$routes[$this->url])) {
            static::$routes[$this->url]['middlewares'] = $this->middlewares;
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
        $this->url = $this->middlewares = null;
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
