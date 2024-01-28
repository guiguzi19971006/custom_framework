<?php

namespace Routes;

use App\Http\Method;
use ReflectionEnum;
use ReflectionMethod;
use ReflectionException;
use Exception;

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
     * 註冊路由
     * 
     * @param string $url
     * @param array $action
     * @param string|null $method
     * @return static
     */
    private static function routing(string $url, array $action, ?string $method = null): static
    {
        static::$routes[] = [
            'method' => $method ?? (Method::GET)->value, 
            'url' => $url, 
            'pattern' => '/^' . preg_replace(['/{[A-Za-z_]+}/', '/\//'], ['([0-9]+)', '\/'], $url) . '$/', 
            'action' => $action
        ];

        return static::getInstance();
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $reflector = new ReflectionEnum(Method::class);
        $httpMethod = strtoupper($name);
        
        if (! $reflector->hasCase($httpMethod)) {
            return;
        }

        try {
            $reflector = new ReflectionMethod(static::class, 'routing');
        } catch (ReflectionException $e) {
            throw $e;
        }

        if (count($arguments) < $reflector->getNumberOfRequiredParameters()) {
            throw new Exception('Must provide at least two parameters for routing');
        }

        foreach ($reflector->getParameters() as $i => $parameter) {
            if (! isset($arguments[$i])) {
                break;
            }

            if (gettype($arguments[$i]) !== $parameter->getType()->getName()) {
                throw new Exception('Provide parameters\' types must correspond the method of routing');
            }
        }

        return static::routing(...array_merge($arguments, [$httpMethod]));
    }
}
