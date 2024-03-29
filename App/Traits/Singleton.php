<?php

namespace App\Traits;

trait Singleton
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * 建立類別實體物件
     * 
     * @param mixed $arguments
     * 
     * @return static
     */
    public static function getInstance(...$arguments)
    {
        if (!isset(static::$instance)) {
            static::$instance = new static(...$arguments);
        }

        return static::$instance;
    }
}
