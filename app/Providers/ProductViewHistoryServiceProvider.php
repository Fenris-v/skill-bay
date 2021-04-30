<?php

namespace App\Providers;

use App\Repository\ConfigRepository;
use App\Repository\ProductViewHistoryRepository;
use App\Services\ProductViewHistoryService;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class ProductViewHistoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ProductViewHistoryRepository $history)
    {
        $this->app->bind(
            ProductViewHistoryService::class,
            function () use ($history) {
                return new ProductViewHistoryService($history, Auth::user());
            }
        );
    }
}
