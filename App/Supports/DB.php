<?php

namespace App\Supports;

final class DB extends Support
{
    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return parent::__callStatic($name, $arguments);
    }
}
