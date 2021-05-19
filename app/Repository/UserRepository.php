<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function __construct(protected ConfigRepository $configRepository)
    {}

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
