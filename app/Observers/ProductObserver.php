<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "updated" event.
     *
     * @param  Product  $product
     * @return void
     * @throws \Exception
     */
    public function saved(Product $product)
    {
        \Cache::tags(Product::PRODUCT_CACHE_TAGS)->flush();
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  Product  $product
     * @return void
     * @throws \Exception
     */
    public function deleted(Product $product)
    {
        \Cache::tags(Product::PRODUCT_CACHE_TAGS)->flush();
    }
}
