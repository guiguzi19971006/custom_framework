<?php

namespace App\Providers;

use App\Containers\Container;
use Exception;

abstract class Provider
{
    /**
     * 綁定服務
     * 
     * @return void
     */
    abstract public static function bind();
}
