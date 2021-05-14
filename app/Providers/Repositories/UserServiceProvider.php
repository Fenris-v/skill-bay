<?php

namespace App\Providers\Repositories;

use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            UserRepository::class,
            function () {
                return new UserRepository();
            }
        );
    }
}
