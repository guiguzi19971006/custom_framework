<?php

date_default_timezone_set('Asia/Taipei');

defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
defined('APP_PATH') || define('APP_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR);
defined('PUBLIC_PATH') || define('PUBLIC_PATH', '/public');
defined('STORAGE_PATH') || define('STORAGE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR);
defined('VIEW_PATH') || define('VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
defined('ENTRY_POINT_PATH') || define('ENTRY_POINT_PATH', '/public/index.php');

$config = require_once '../config.php';
require_once '../helper.php';
require_once '../error_handler.php';
require_once '../exception_handler.php';
require_once '../vendor/autoload.php';

// 確認是否正確定義 Service Providers
if (!isset($config['providers']) || !is_array($config['providers'])) {
    throw new \Exception("Missing key 'providers' in " . dirname(__DIR__) . DIRECTORY_SEPARATOR . "config.php");
}

use App\Containers\Container;
use App\Bootstrap\Bootstrapping;

// 註冊服務
Bootstrapping::registerServices($config['providers']);

require_once '../shutdown.php';
require_once '../routes.php';

$bootstrapping = Container::get(Bootstrapping::class);

// 處理請求
$bootstrapping->init();
