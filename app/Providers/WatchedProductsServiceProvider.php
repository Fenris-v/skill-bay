<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WatchedProductsService;

class WatchedProductsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WatchedProductsService::class, function() {
            return new WatchedProductsService();
        });
    }
}
