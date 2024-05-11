<?php

namespace App\Supports;

use App\Containers\Container;
use App\Utilities\Route as RouteUtility;

final class Route extends Support
{
    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        // 清除路由屬性
        Container::get(RouteUtility::class)->clear();

        return parent::__callStatic($name, $arguments);
    }
}
