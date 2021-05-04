<?php


namespace App\Providers\Repositories;


use App\Repository\CatalogRepository;
use App\Repository\CompareProductRepository;

class CompareProductServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CompareProductRepository::class,
            function () {
                return new CompareProductRepository();
            }
        );
    }
}
