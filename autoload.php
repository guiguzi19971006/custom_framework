<?php

spl_autoload_register(function (string $class) {
    $filePath = ROOT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (!file_exists($filePath)) {
        throw new \Exception('Failed to load files');
    }

    require_once $filePath;
});
