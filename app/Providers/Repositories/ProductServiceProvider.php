<?php

namespace App\Providers\Repositories;

use App\Repository\ProductRepository;
use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            ProductRepository::class,
            fn() => new ProductRepository($configs)
        );
    }
}
