<?php

namespace App\Providers;

abstract class Provider
{
    /**
     * 綁定服務
     * 
     * @return void
     */
    abstract public static function bind();
}
