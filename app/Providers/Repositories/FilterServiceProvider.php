<?php

namespace App\Providers\Repositories;

use App\Repository\FilterRepository;
use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            FilterRepository::class,
            function () use ($configs) {
                return new FilterRepository($configs);
            }
        );
    }
}
