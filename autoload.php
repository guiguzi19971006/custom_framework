<?php

spl_autoload_register(function ($class) {
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (!file_exists($filePath)) {
        throw new Exception('Autoload file(s) failed.');
    }

    require_once $filePath;
});
