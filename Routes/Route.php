<?php

namespace Routes;

use App\Containers\Container;
use App\Utilities\Route as RouteUtility;

class Route
{
    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return Container::get(RouteUtility::class)->$name(...$arguments);
    }
}
