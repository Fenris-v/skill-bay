<?php

namespace App\Providers\Repositories;

use App\Repository\ConfigRepository;
use App\Repository\ProductViewHistoryRepository;
use Illuminate\Support\ServiceProvider;

class ProductViewHistoryProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            ProductViewHistoryRepository::class,
            function () use ($configs) {
                return new ProductViewHistoryRepository($configs);
            }
        );
    }
}
