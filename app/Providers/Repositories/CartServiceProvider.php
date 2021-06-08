<?php

namespace App\Providers\Repositories;

use App\Repository\CartRepository;
use App\Services\VisitorService;
use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\VisitorService as VisitorServiceInterface;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs, VisitorServiceInterface $visitorService)
    {
        $this->app->bind(
            CartRepository::class,
            fn() => new CartRepository($configs, $visitorService)
        );
    }
}
