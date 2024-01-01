<?php

namespace App\Providers;

use App\Containers\Container;
use ReflectionClass;
use Exception;

class Provider
{
    /**
     * 取得類別實體物件
     * 
     * @param \ReflectionClass $class
     * @return object|null
     * @throws \Exception
     */
    public static function getInstance(ReflectionClass $class): ?object
    {
        if (!$class->isInstantiable()) {
            return null;
        }

        if (($constructor = $class->getConstructor()) === null || $constructor->getNumberOfRequiredParameters() === 0) {
            return $class->newInstance();
        }

        $params = [];

        foreach ($constructor->getParameters() as $param) {
            if (($paramType = $param->getType()) === null) {
                throw new Exception('All parameters of ' . $class->getName() . '::' . $constructor->getName() . '() must give a specific type.');
            }

            $paramTypeName = $paramType->getName();

            if (!in_array($paramTypeName, Container::$bindings['services']) && !in_array($paramTypeName, Container::$bindings['repositories'])) {
                throw new Exception('Parameters\' type of ' . $class->getName() . '::' . $constructor->getName() . ' are not registered in service container or repository container.');
            }

            $params[] = static::getInstance(new ReflectionClass($paramTypeName));
        }

        return $class->newInstanceArgs($params);
    }
}
