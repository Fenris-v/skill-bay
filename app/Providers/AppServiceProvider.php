<?php

namespace App\Providers;

use App\Contracts\ProductViewHistoryService as ProductViewHistoryServiceContract;
use App\Contracts\OrderPaymentService as OrderPaymentServiceContract;
use App\Contracts\ProductReviewService as ProductReviewServiceContract;
use App\Services\CompareProductsService;
use App\Services\OrderPaymentService;
use App\Services\ProductCartService;
use App\Contracts\ProductCartService as ProductCartServiceContract;
use App\Services\ProductReviewService;
use App\Services\ProductViewHistoryService;
use App\Services\VisitorService;
use Illuminate\Pagination\Paginator;
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

        // Сервис для оплаты заказа и проверки статуса оплаты.
        $this->app->singleton(
            OrderPaymentServiceContract::class,
            OrderPaymentService::class
        );

        // Сервис для работы с отзывами по товарам.
        $this->app->singleton(
            ProductReviewServiceContract::class,
            ProductReviewService::class
        );

        // Сервис для работы со списком товаров для сравнения
        $this->app->singleton(
            CompareProductsService::class,
            CompareProductsService::class
        );

        // Сервис для получения объекта Visitor
        $this->app->singleton(
            VisitorService::class,
            VisitorService::class
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

        Paginator::defaultView('layouts.pagination.index');
    }
}
