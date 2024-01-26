<?php

set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
    $errorType = match ($errno) {
        E_ERROR, E_USER_ERROR => 'Fatal error', 
        E_WARNING, E_USER_WARNING => 'Warning', 
        E_PARSE => 'Parse error', 
        E_NOTICE, E_USER_NOTICE => 'Notice', 
        default => 'Error'
    };
    $errorMessage = "$errorType: $errstr in $errfile on line $errline.";
    logging($errorMessage);
    view('error', ['error' => $errorMessage]);
});
