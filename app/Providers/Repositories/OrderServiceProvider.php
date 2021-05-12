<?php

namespace App\Providers\Repositories;

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
    public function boot(OrderPaymentService $payment)
    {
        $this->app->singleton(
            OrdersRepository::class,
            function () use ($payment) {
                return new OrdersRepository($payment);
            }
        );
    }
}
