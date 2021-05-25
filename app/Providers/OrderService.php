<?php

namespace App\Providers;

use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(OrderService::class, function () {
            return new OrderService();
        });
    }
}
