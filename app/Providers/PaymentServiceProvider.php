<?php

namespace App\Providers;

use App\Services\FakePaymentService;
use Illuminate\Support\ServiceProvider;
use App\Services\PayByCardService;
use App\Services\PayByRandomAccountService;
use App\Contracts\PayByRandomAccountService as PayByRandomAccountServiceContract;
use App\Contracts\PayByCardService as PayByCardServiceContract;
use App\Contracts\PaymentService as PaymentServiceContract;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            PayByCardServiceContract::class,
            PayByCardService::class
        );

        $this->app->bind(
            PayByRandomAccountServiceContract::class,
            PayByRandomAccountService::class
        );

        $this->app->bind(
            PaymentServiceContract::class,
            FakePaymentService::class
        );
    }
}
