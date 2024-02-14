<?php

set_exception_handler(function (\Throwable $ex) {
    $exception = [
        'code' => $ex->getCode(),
        'message' => $ex->getMessage(),
        'file' => $ex->getFile(),
        'line' => $ex->getLine(),
    ];
    logToFile($ex);
    view('exception', ['exception' => $exception]);
});
