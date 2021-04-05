<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CompareProductsService;

class CompareProductsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CompareProductsService::class, function() {
            return new CompareProductsService();
        });
    }
}
