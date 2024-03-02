<?php

namespace Routes;

use App\Http\Method;
use App\Traits\Singleton;
use ReflectionEnum;
use ReflectionMethod;
use ReflectionException;
use Exception;

class Route
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
    private static function register(string $url, array $action, ?string $method = null)
    {
        static::$routes[] = [
            'method' => $method ?? (Method::GET)->value,
            'url' => $url,
            'pattern' => '/^' . preg_replace(['/{[A-Za-z_]+}/', '/\//'], ['([0-9]+)', '\/'], $url) . '$/',
            'action' => array_values($action)
        ];

        return static::getInstance();
    }

    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     * 
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $reflector = new ReflectionEnum(Method::class);
        $httpMethod = strtoupper($name);

        if (!$reflector->hasCase($httpMethod)) {
            throw new Exception('Call to undefined method ' . static::class . '::' . $name . '()');
        }

        try {
            $reflector = new ReflectionMethod(static::class, 'register');
        } catch (ReflectionException $e) {
            throw $e;
        }

        if (count($arguments) < $reflector->getNumberOfRequiredParameters()) {
            throw new Exception('Must provide at least two parameters for registering routes');
        }

        foreach ($reflector->getParameters() as $i => $parameter) {
            if (!isset($arguments[$i])) {
                break;
            }

            if (gettype($arguments[$i]) !== $parameter->getType()->getName()) {
                throw new Exception('Provide parameters\' types must correspond the method of routing');
            }
        }

        return static::register(...array_merge($arguments, [$httpMethod]));
    }
}
