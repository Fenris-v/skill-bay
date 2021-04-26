<?php

namespace App\Providers\Repositories;

use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ConfigRepository::class,
            function () {
                return new ConfigRepository();
            }
        );
    }
}
