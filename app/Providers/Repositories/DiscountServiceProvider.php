<?php

namespace App\Providers\Repositories;

use App\Repository\ConfigRepository;
use App\Repository\DiscountRepository;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            DiscountRepository::class,
            function () use ($configs) {
                return new DiscountRepository($configs);
            }
        );
    }
}
