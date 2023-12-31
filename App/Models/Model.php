<?php

namespace App\Models;

use PDO;

class Model
{
    /**
     * PDO 類別實體物件
     * 
     * @var \PDO
     */
    private $pdo;

    /**
     * PDOStatement 類別實體物件
     * 
     * @var \PDOStatement
     */
    private $stmt;

    /**
     * SQL Query
     * 
     * @var string
     */
    private string $sqlQuery;

    /**
     * 建構式
     * 
     * @return void
     */
    protected function __construct()
    {
        $this->connect([
            'host' => env('DB_HOST', '127.0.0.1'), 
            'port' => env('DB_PORT', 3306), 
            'name' => env('DB_NAME', 'store'), 
            'charset' => env('DB_CHARSET', 'utf8mb4'), 
            'collate' => env('DB_COLLATE', 'utf8mb4_unicode_ci'), 
            'user' => env('DB_USER', 'root'), 
            'password' => env('DB_PASSWORD', 'password')
        ]);
    }

    /**
     * 連線資料庫
     * 
     * @param array $connection
     * @return void
     */
    private function connect(array $connection): void
    {
        $dsn = 'mysql:host=' . $connection['host'] . ';port=' . $connection['port'] . ';dbname=' . $connection['name'] . ';charset=' . $connection['charset'];

        if (!isset($this->pdo)) {
            $this->pdo = new PDO($dsn, $connection['user'], $connection['password']);
        }
    }

    /**
     * 執行 SQL Query
     * 
     * @param string $query
     * @return self
     */
    public function query(string $query): self
    {
        $this->sqlQuery = $query;
        $this->stmt = $this->pdo->prepare($this->sqlQuery);
        return $this;
    }

    /**
     * 綁定 SQL 參數
     * 
     * @param array|null $params
     * @return self
     */
    public function bindParams(?array $params = null): self
    {
        $this->stmt->execute($params);
        return $this;
    }

    /**
     * 取得查詢結果
     * 
     * @return array|null
     */
    public function get(): ?array
    {
        $datas = $this->stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        $this->pdo = $this->stmt = $this->sqlQuery = null;
        return $datas;
    }
}
