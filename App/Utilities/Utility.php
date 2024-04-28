<?php

namespace App\Utilities;

class Utility
{
    /**
     * @var array
     */
    public static array $bindings = [
        \App\Supports\DB::class => \App\Utilities\DB::class,
        \App\Supports\Route::class => \App\Utilities\Route::class
    ];
}
