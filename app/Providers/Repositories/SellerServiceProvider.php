<?php

namespace App\Providers\Repositories;

use App\Repository\SellerRepository;
use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class SellerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            SellerRepository::class,
            fn() => new SellerRepository($configs)
        );
    }
}
