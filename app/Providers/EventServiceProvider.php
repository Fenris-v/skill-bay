<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Observers\BannerObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\SellerObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Banner::observe(BannerObserver::class);
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        Seller::observe(SellerObserver::class);
    }
}
