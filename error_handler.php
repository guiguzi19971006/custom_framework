<?php

set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
    if (!(error_reporting() & $errno)) {
        return;
    }

    throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
});
