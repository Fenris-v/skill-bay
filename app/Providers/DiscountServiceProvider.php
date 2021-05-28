<?php

namespace App\Providers;

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
    public function boot(DiscountRepository $repository)
    {
        $this->app->bind(
            DiscountService::class,
            function () use ($repository) {
                return new DiscountService($repository);
            }
        );
    }
}
