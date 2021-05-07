<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private ConfigRepository $configRepository;
    private int $ttl;

    public function __construct()
    {
        $this->configRepository = app(ConfigRepository::class);
        $this->ttl = $this->configRepository->getCacheLifetime(now()->addDay());
    }

    /**
     * Осуществляет валидацию пользовательского ввода
     *
     * @param array $values
     * @return bool
     */
    protected function validate(array $values)
    {
        Validator::make(
            $values,
            $this->getRules(array_keys($values)),
            $messages = [
                'unique' => __('orderPage.errors.userAlreadyExists'),
            ]
        )
            ->validate()
        ;
    }

    /**
     * Возвращает правила валидации
     *
     * @param array $needField
     * @return array
     */
    protected function getRules(array $needField): array
    {
        return collect([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|confirmed',
            'phone' => ['required', 'regex:/^\+7 \([0-9]{3}\) - [0-9]{3} - [0-9]{2} - [0-9]{2}$/']
        ])
            ->reduceWithKeys(
                fn($rules, $rule, $field) => in_array($field, $needField) ? array_merge($rules, [$field => $rule]) : $rules,
                []
            )
        ;
    }

    /**
     * Возвращает сведения о том, существует ли пользователь с переданным email.
     *
     * @param array $input
     * @return bool
     */
    public function store(array $input): bool
    {
        $this->validate($input);
        $user = User::create(collect($input)->except(['password_confirmation'])->toArray());
        dd($user);
    }

}
