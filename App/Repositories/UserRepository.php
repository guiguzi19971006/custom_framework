<?php

namespace App\Repositories;

use App\Supports\DB;
use App\Models\User;

class UserRepository
{
    /**
     * 新增使用者
     * 
     * @param array $user
     * 
     * @return mixed
     */
    public function createUser(array $user)
    {
        $statement = <<< 'SQL_STATEMENT'
            insert into `user` (`email`, `password`, `name`, `gender`, `birthday`, `phone`, `address`, `registration_time`) values
            (?, ?, ?, ?, ?, ?, ?, ?)
        SQL_STATEMENT;
        return DB::query($statement, array_values($user))->insertedId();
    }

    /**
     * 透過電子郵件或手機號碼取得使用者資訊
     * 
     * @param string $email
     * @param string $phone
     * 
     * @return array|null
     */
    public function getUserDataByEmailOrPhone(string $email, string $phone)
    {
        $statement = <<< 'SQL_STATEMENT'
            select * from `user`
            where (`email` = ? or `phone` = ?)
            and `deleted_at` is null
            limit 1
        SQL_STATEMENT;
        return DB::query($statement, [$email, $phone])->get(true);
    }

    /**
     * 透過使用者編號更新使用者帳號啟用狀態
     * 
     * @param int $isActivated
     * @param int $userId
     * 
     * @return int
     */
    public function updateUserActivationStatusByUserId(int $isActivated, int $userId)
    {
        $statement = <<< 'SQL_STATEMENT'
            update `user`
            set `is_activated` = ?
            where `id` = ?
        SQL_STATEMENT;
        return DB::query($statement, [$isActivated, $userId])->affectedRowNums();
    }
}
