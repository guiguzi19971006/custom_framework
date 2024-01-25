<?php

date_default_timezone_set('Asia/Taipei');

defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
defined('APP_URL') || define('APP_URL', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR);
defined('PUBLIC_PATH') || define('PUBLIC_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once '../helper.php';
require_once '../shutdown.php';
require_once '../exception_handler.php';
require_once '../autoload.php';
require_once '../routes.php';

use App\Bootstrap\Bootstrapping;

Bootstrapping::init();
