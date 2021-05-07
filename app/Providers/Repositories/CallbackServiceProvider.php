<?php

namespace App\Providers\Repositories;

use App\Repository\CallbackRepository;
use Illuminate\Support\ServiceProvider;

class CallbackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            CallbackRepository::class,
            function () {
                return new CallbackRepository();
            }
        );
    }
}
