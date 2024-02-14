<?php

namespace App\Providers;

use App\Containers\Container;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionException;
use Exception;

class Provider
{
    /**
     * 取得類別實體物件
     * 
     * @param string $class
     * 
     * @return object
     * 
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function getInstance(string $class)
    {
        try {
            $reflector = new ReflectionClass($class);
        } catch (ReflectionException $e) {
            throw $e;
        }

        if (!$reflector->isInstantiable()) {
            throw new ReflectionException('The provided class is not instantiable');
        }

        if (($constructor = $reflector->getConstructor()) === null || $constructor->getNumberOfRequiredParameters() === 0) {
            return $reflector->newInstance();
        }

        $params = [];

        foreach ($constructor->getParameters() as $param) {
            if (($paramType = $param->getType()) === null || !($paramType instanceof ReflectionNamedType)) {
                throw new Exception("The parameters' types of $class::__construct() must be set as named type");
            }

            $paramTypeName = $paramType->getName();

            if (!in_array($paramTypeName, Container::$bindings['services']) && !in_array($paramTypeName, Container::$bindings['repositories'])) {
                throw new Exception("The class [$paramTypeName] are not registered in container");
            }

            $params[] = static::getInstance($paramTypeName);
        }

        return $reflector->newInstanceArgs($params);
    }
}
