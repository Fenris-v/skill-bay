<?php

namespace App\Providers;

use App\Contracts\ProductViewHistoryService as ProductViewHistoryServiceContract;
use App\Services\ProductCartService;
use App\Contracts\ProductCartService as ProductCartServiceContract;
use App\Services\ProductViewHistoryService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Сервис для работы с корзиной товаров.
        $this->app->singleton(
            ProductCartServiceContract::class,
            ProductCartService::class
        );

        // Сервис для работы с просмотренными товарами.
        $this->app->singleton(
            ProductViewHistoryServiceContract::class,
            ProductViewHistoryService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('price', function ($expression) {
            return "$<?= number_format($expression, 2, '.', ' ') ?>";
        });
    }
}
