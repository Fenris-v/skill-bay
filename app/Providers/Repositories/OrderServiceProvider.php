<?php

namespace App\Providers\Repositories;

use App\Repository\ConfigRepository;
use App\Repository\OrdersRepository;
use App\Services\OrderPaymentService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(OrderPaymentService $payment, ConfigRepository $configs)
    {
        $this->app->singleton(
            OrdersRepository::class,
            function () use ($payment, $configs) {
                return new OrdersRepository($payment, $configs);
            }
        );
    }
}
