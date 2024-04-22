<?php

namespace App\Utilities;

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
     * @param \PDO $pdo
     * 
     * @return void
     */
    private function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
     * @return static|false
     * 
     * @throws \Exception
     */
    public function query(string $statement, ?array $params = null)
    {
        $this->stmt = $this->pdo->prepare($statement);

        if ($this->stmt->execute($params) === false) {
            throw new Exception('Failed to execute SQL statement');
        }

        return $this->stmt->execute($params) ? $this : false;
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
}
