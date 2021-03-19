<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AdminSettingsService;

class AdminSettingsServiceProvider extends ServiceProvider
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
        $this->app->bind(AdminSettingsService::class, function() {
            return new AdminSettingsService();
        });
    }
}
