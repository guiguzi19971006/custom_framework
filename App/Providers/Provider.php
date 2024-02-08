<?php

namespace App\Providers;

use App\Containers\Container;
use ReflectionClass;
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
            if (($paramType = $param->getType()) === null) {
                throw new Exception('All parameters of ' . $reflector->getName() . '::' . $constructor->getName() . '() must give a specific type');
            }

            $paramTypeName = $paramType->getName();

            if (!in_array($paramTypeName, Container::$bindings['services']) && !in_array($paramTypeName, Container::$bindings['repositories'])) {
                throw new Exception('Parameters\' type of ' . $reflector->getName() . '::' . $constructor->getName() . ' are not registered in container');
            }

            $params[] = static::getInstance($paramTypeName);
        }

        return $reflector->newInstanceArgs($params);
    }
}
