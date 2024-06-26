<?php

namespace App\Providers;

use App\Containers\Container;
use App\Utilities\DB;
use PDO;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * 註冊服務
     * 
     * @return void
     */
    public static function register()
    {
        // 綁定 PDO
        Container::bind(PDO::class, function () {
            $host = env('DB_HOST');
            $port = env('DB_PORT');
            $name = env('DB_NAME');
            $charset = env('DB_CHARSET');
            $user = env('DB_USER');
            $password = env('DB_PASSWORD');
            $dsn = "mysql:host=$host;port=$port;dbname=$name;charset=$charset";
            return DB::getInstance()->getPDOInstance($dsn, $user, $password);
        });

        Container::bind(DB::class, function () {
            // 連線至資料庫
            Container::get(PDO::class);

            return DB::getInstance();
        });
    }
}
