<?php

require_once './autoload.php';
require_once './constant.php';
require_once './helper.php';
require_once './routes.php';

use App\Bootstrap\Bootstrapping;

error_reporting(E_ALL);

register_shutdown_function(function () {
    if (($errorMessage = getErrorMessage()) === null) {
        exit;
    }

    logging($errorMessage);
});

date_default_timezone_set('Asia/Taipei');

Bootstrapping::init();
