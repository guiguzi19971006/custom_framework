<?php

error_reporting(E_ALL);

register_shutdown_function(function () {
    if (($error = error_get_last()) === null) {
        exit;
    }

    $errorType = match ($error['type']) {
        E_ERROR => 'Fatal error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parse error',
        E_NOTICE => 'Notice',
        default => 'Error'
    };

    logging("$errorType: {$error['message']} in {$error['file']} on line {$error['line']}.");
});
