<?php

namespace App\Providers;

use App\Containers\Container;
use App\Requests\Request;
use App\Bootstrap\Bootstrapping;

class BootstrappingServiceProvider extends ServiceProvider
{
    /**
     * 綁定服務
     * 
     * @return void
     */
    public static function register()
    {
        Container::bind(Request::class, function () {
            return Request::getInstance();
        });

        Container::bind(Bootstrapping::class, function () {
            return Bootstrapping::getInstance(Container::get(Request::class));
        });
    }
}
