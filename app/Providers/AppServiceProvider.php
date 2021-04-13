<?php

namespace App\Providers;

use App\Contracts\OrderPaymentService as OrderPaymentServiceContract;
use App\Services\OrderPaymentService;
use App\Services\ProductCartService;
use App\Contracts\ProductCartService as ProductCartServiceContract;
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

        // Сервис для оплаты заказа и проверки статуса оплаты.
        $this->app->singleton(
            OrderPaymentServiceContract::class,
            OrderPaymentService::class
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
            return "<?= number_format($expression, 2, '.', ' ') ?>";
        });
    }
}
