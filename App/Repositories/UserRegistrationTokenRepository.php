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
}
