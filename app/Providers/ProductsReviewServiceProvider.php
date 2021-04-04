<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProductsReviewService;

class ProductsReviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ProductsReviewService::class, function() {
            return new ProductsReviewService();
        });
    }
}
