<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DiscountService;

class DiscountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(DiscountService::class, function () {
            return new DiscountService();
        });
    }
}
