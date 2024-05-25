<?php

namespace App\Providers;

abstract class ServiceProvider
{
    /**
     * 註冊服務
     * 
     * @return void
     */
    abstract public static function register();
}
