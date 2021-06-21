<?php

namespace App\Providers;

use App\Contracts\ProductCartService;
use App\Repository\DiscountRepository;
use App\Services\DiscountService;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(
        DiscountRepository $repository,
        ProductCartService $productCartService
    ) {
        $this->app->bind(
            DiscountService::class,
            function () use ($repository, $productCartService) {
                return new DiscountService($repository, $productCartService);
            }
        );
    }
}
