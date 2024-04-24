<?php

namespace App\Providers;

use App\Containers\Container;
use App\Utilities\Route;

class RouteServiceProvider extends ServiceProvider
{
    public static function register()
    {
        Container::bind(Route::class, function () {
            return Route::getInstance();
        });
    }
}
