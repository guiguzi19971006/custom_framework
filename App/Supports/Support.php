<?php

namespace App\Supports;

use App\Containers\Container;
use App\Utilities\Utility;
use Exception;

class Support
{
    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     * 
     * @throws \Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (!isset(Utility::$bindings[static::class])) {
            throw new Exception('Missing key \'' . static::class . '\' in ' . Utility::class . '::$bindings');
        }

        return Container::get(Utility::$bindings[static::class])->$name(...$arguments);
    }
}
