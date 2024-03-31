<?php

namespace App\Providers;

abstract class ServiceProvider
{
    /**
     * 綁定服務
     * 
     * @return void
     */
    abstract public static function register();
}
