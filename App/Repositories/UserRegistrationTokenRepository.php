<?php

namespace App\Repositories;

use App\Supports\DB;

class UserRegistrationTokenRepository
{
    /**
     * 新增使用者註冊 token
     * 
     * @param array $data
     * 
     * @return mixed
     */
    public function createUserRegistrationToken(array $data)
    {
        $statement = <<< 'SQL_STATEMENT'
            insert into `user_registration_token` (`user_id`, `content`, `expiration_time`) values
            (?, ?, ?)
        SQL_STATEMENT;
        return DB::query($statement, array_values($data))->insertedId();
    }

    /**
     * 透過使用者編號刪除使用者註冊 token
     * 
     * @param int $userId
     * 
     * @return int
     */
    public function removeUserRegistrationTokenByUserId(int $userId)
    {
        $statement = <<< 'SQL_STATEMENT'
            delete from `user_registration_token`
            where `user_id` = ?
        SQL_STATEMENT;
        return DB::query($statement, [$userId])->affectedRowNums();
    }

    /**
     * 透過 token 內容取得有效的使用者註冊 token
     * 
     * @param string $token
     * @param string $expirationTime
     * 
     * @return array|null
     */
    public function getTheValidUserRegistrationTokenByTokenContent(string $token, string $expirationTime)
    {
        $statement = <<< 'SQL_STATEMENT'
            select * from `user_registration_token`
            where `content` = ?
            and `expiration_time` > ?
            limit 1
        SQL_STATEMENT;
        return DB::query($statement, [$token, $expirationTime])->get(true);
    }
}
