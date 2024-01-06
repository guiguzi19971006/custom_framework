<?php

spl_autoload_register(function ($class) {
    $filePath = ROOT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (!file_exists($filePath)) {
        throw new Exception('Load file(s) failed.');
    }

    require_once $filePath;
});
