<?php

namespace App\Providers\Repositories;

use App\Repository\ConfigRepository;
use App\Repository\PaymentRepository;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            PaymentRepository::class,
            fn() => new PaymentRepository($configs)
        );
    }
}
