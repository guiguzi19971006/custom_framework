<?php

namespace Database;

use App\Containers\Container;
use App\Utilities\DB as Database;
use Exception;

class DB
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
        if (!method_exists(Database::class, $name)) {
            throw new Exception("Call to undefined method " . __CLASS__ . "::$name()");
        }

        return Container::get(Database::class)->$name(...$arguments);
    }
}
