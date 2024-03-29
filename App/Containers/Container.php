<?php

namespace App\Containers;

use Exception;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionException;

class Container
{
    /**
     * @var array
     */
    private static array $bindings = [];

    /**
     * 綁定
     * 
     * @param string $abstract
     * @param callable $concrete
     * 
     * @return void
     */
    public static function bind(string $abstract, callable $concrete)
    {
        static::$bindings[$abstract] = $concrete;
    }

    /**
     * 取得綁定
     * 
     * @param string $abstract
     * 
     * @return mixed
     * 
     * @throws \Exception
     */
    public static function get(string $abstract)
    {
        if (!isset(static::$bindings[$abstract])) {
            throw new Exception("Target binding [$abstract] does not exist");
        }

        $concrete = static::$bindings[$abstract];
        return $concrete();
    }

    /**
     * 取得完成解析後的類別實體物件
     * 
     * @param string $abstract
     * 
     * @return object
     * 
     * @throws \Exception
     * @throws \ReflectionException
     */
    public static function resolve(string $abstract)
    {
        if (isset(static::$bindings[$abstract]) && is_callable($concrete = static::$bindings[$abstract])) {
            $concrete();
        }

        try {
            $classReflector = new ReflectionClass($abstract);
        } catch (ReflectionException $e) {
            throw $e;
        }

        if (!$classReflector->isInstantiable()) {
            throw new Exception("Target class [$abstract] is not instantiable");
        }

        if (($methodReflector = $classReflector->getConstructor()) === null || $methodReflector->getNumberOfRequiredParameters() === 0) {
            return new $abstract();
        }

        $parameterReflectors = $methodReflector->getParameters();
        $parameters = [];

        foreach ($parameterReflectors as $parameterReflector) {
            if ($parameterReflector->isVariadic()) {
                continue;
            }

            if ($parameterReflector->isDefaultValueAvailable()) {
                $parameters[] = $parameterReflector->getDefaultValue();
                continue;
            }

            $typeReflector = $parameterReflector->getType();

            if ($typeReflector === null || !($typeReflector instanceof ReflectionNamedType)) {
                throw new Exception("Parameter [$" . $parameterReflector->getName() . "] of [" . $abstract . "::" . $methodReflector->getName() . "()] must be specified as named type");
            }

            if ($typeReflector->isBuiltin()) {
                throw new Exception("Built-in type of parameter [$" . $parameterReflector->getName() . "] of [" . $abstract . "::" . $methodReflector->getName() . "()] must have a default value");
            }

            $parameters[] = static::resolve($typeReflector->getName());
        }

        return $classReflector->newInstanceArgs($parameters);
    }
}
