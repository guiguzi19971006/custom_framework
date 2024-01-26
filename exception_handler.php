<?php

set_exception_handler(function (Throwable $ex) {
    logging($ex);
    view('exception', ['exception' => $ex]);
});
