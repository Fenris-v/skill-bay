<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PaymentMethodInterface;
use App\Services\PayByCardService;
use App\Services\PayByRandomAccountService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PaymentMethodInterface::class, function($paymentMethod) {
            if ($paymentMethod) {
                return new PayByCardService();
            } else {
                return new PayByRandomAccountService();
            }
        });
    }
}
