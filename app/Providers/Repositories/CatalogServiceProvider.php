<?php

namespace App\Providers\Repositories;

use App\Repository\CatalogRepository;
use App\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configs)
    {
        $this->app->bind(
            CatalogRepository::class,
            function () use ($configs) {
                return new CatalogRepository($configs);
            }
        );
    }
}
