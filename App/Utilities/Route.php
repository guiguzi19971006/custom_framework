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
     */
    private function register(string $url, array $action, ?string $method = null)
    {
        static::$routes[] = [
            'method' => $method ?? Method::GET,
            'url' => $url,
            'pattern' => '/^' . preg_replace(['/{[A-Za-z_]+}/', '/\//'], ['([0-9]+)', '\/'], $url) . '$/',
            'action' => array_values($action)
        ];

        return $this;
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

        if (!$classReflector->hasConstant(strtoupper($httpMethod))) {
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
