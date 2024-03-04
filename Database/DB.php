<?php

namespace Database;

use App\Traits\Singleton;
use PDO;
use Exception;

class DB
{
    use Singleton;

    /**
     * \PDO 類別實體物件
     * 
     * @var \PDO
     */
    private $pdo;

    /**
     * \PDOStatement 類別實體物件
     * 
     * @var \PDOStatement
     */
    private $stmt;

    /**
     * 建構式
     * 
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * 連線資料庫
     * 
     * @return void
     */
    public function connect()
    {
        if (isset($this->pdo)) {
            return;
        }

        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $name = env('DB_NAME');
        $charset = env('DB_CHARSET');
        $user = env('DB_USER');
        $password = env('DB_PASSWORD');
        $dsn = "mysql:host=$host;port=$port;dbname=$name;charset=$charset";
        $this->pdo = new PDO($dsn, $user, $password);
    }

    /**
     * 關閉資料庫連線
     * 
     * @return void
     */
    public function disconnect()
    {
        $this->pdo = $this->stmt = null;
    }

    /**
     * 執行 SQL statement
     * 
     * @param string $statement
     * @param array|null $params
     * 
     * @return static
     */
    public function query(string $statement, ?array $params = null)
    {
        $this->stmt = $this->pdo->prepare($statement);
        $this->stmt->execute($params);
        return $this;
    }

    /**
     * 取得資料表受影響列數
     * 
     * @return int
     */
    public function affectedRowNums()
    {
        return isset($this->stmt) ? $this->stmt->rowCount() : 0;
    }

    /**
     * 取得查詢資料
     * 
     * @return array|null
     * 
     * @throws \Exception
     */
    public function get()
    {
        if (!isset($this->stmt)) {
            throw new Exception('Please execute SQL statement before get datas');
        }

        $datas = [];

        while (($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $datas[] = $row;
        }

        return $datas ?: null;
    }
}
