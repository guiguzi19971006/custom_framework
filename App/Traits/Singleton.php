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
     * @return static
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
