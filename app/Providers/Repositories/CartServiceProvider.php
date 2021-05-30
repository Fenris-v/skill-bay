<?php

namespace App\Providers\Repositories;

use App\Repository\CartRepository;
use App\Services\VisitorService;
use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs, VisitorService $visitorService)
    {
        $this->app->bind(
            CartRepository::class,
            fn() => new CartRepository($configs, $visitorService)
        );
    }
}
