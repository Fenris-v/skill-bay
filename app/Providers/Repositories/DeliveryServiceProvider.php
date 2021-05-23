<?php

namespace App\Providers\Repositories;

use App\Repository\ConfigRepository;
use App\Repository\DeliveryRepository;
use Illuminate\Support\ServiceProvider;

class DeliveryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            DeliveryRepository::class,
            fn() => new DeliveryRepository($configs)
        );
    }
}
