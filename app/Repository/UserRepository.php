<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    /**
     * Возвращает юзера по id
     * @param int $id
     * @param array $columns
     * @return User
     */
    public function getById(int $id, array $columns = ['*']): User
    {
        return User::where('id', $id)->first($columns);
    }
}
