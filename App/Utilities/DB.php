<?php

namespace App\Utilities;

use App\Traits\Singleton;
use PDO;
use Exception;

class DB extends Utility
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
     * 
     * @throws \Exception
     */
    public function query(string $statement, ?array $params = null)
    {
        $this->stmt = $this->pdo->prepare($statement);

        if ($this->stmt->execute($params) === false) {
            throw new Exception('Failed to execute the SQL statement');
        }

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
     * 取得新增資料後的該資料列編號
     * 
     * @return mixed
     */
    public function insertedId()
    {
        $data = $this->query('select last_insert_id() as `id`')->get(true);
        return $data['id'] ?: null;
    }

    /**
     * 取得查詢資料
     * 
     * @param bool $isOnlyGettingFirstRow
     * 
     * @return array|null
     * 
     * @throws \Exception
     */
    public function get(bool $isOnlyGettingFirstRow = false)
    {
        if (!isset($this->stmt)) {
            throw new Exception('Please execute SQL statement before get datas');
        }

        if ($isOnlyGettingFirstRow) {
            return $this->stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        }

        $datas = [];

        while (($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
            $datas[] = $row;
        }

        return $datas ?: null;
    }

    /**
     * 取得 PDO 類別實體物件
     * 
     * @param string $dsn
     * @param string $user
     * @param string $password
     * 
     * @return \PDO
     */
    public function getPDOInstance(string $dsn, string $user, string $password)
    {
        return $this->pdo = $this->pdo ?? new PDO($dsn, $user, $password);
    }

    /**
     * @param string $name
     * @param array $arguments
     * 
     * @return static
     */
    public function __call(string $name, array $arguments)
    {
    }
}
