<?php

set_exception_handler(function (Throwable $e) {
    logging('Exception: ' . $e->getMessage());
});
