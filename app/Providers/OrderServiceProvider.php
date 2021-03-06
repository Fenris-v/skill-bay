<?php

namespace App\Providers;

use App\Repository\OrdersRepository;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(
        OrdersRepository $ordersRepository,
        UserService $userService
    ) {
        $this->app->singleton(
            OrderService::class,
            fn() => new OrderService($ordersRepository, $userService)
        );
    }
}
