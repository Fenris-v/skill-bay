<?php

namespace App\Providers;

use App\Repository\ConfigRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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

        $this->app->singleton(
            ProductRepository::class,
            function () {
                return new ProductRepository();
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
