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
     * Осуществляет валидацию пользовательского ввода
     *
     * @param array $values
     * @param array $rules
     */
    protected function validate(array $values, array $rules)
    {
        Validator::make(
            $values,
            $rules,
            $messages = [
                'unique' => __('orderPage.errors.userAlreadyExists'),
            ]
        )
            ->validate()
        ;
    }

    /**
     * Возвращает сведения о том, существует ли пользователь с переданным email.
     *
     * @param array $input
     * @return User
     */
    public function store(array $input): User
    {
        $this->validate($input, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|confirmed',
            'phone' => ['required', 'regex:/^\+7 \(\d{3}\) \d{3} - \d{2} - \d{2}$/']
        ]);
        $user = User::create(collect($input)->only(['name', 'phone', 'email', 'password'])->toArray());
        Auth::login($user);
        Cache::tags([User::class, Cart::class])->flush();

        return $user;
    }

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
