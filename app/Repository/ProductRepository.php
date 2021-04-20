<?php

namespace App\Repository;

use App\Models\Product;
use Cache;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class ProductRepository
{
    /**
     * Возвращает топ товаров на главной странице.
     *
     * @param  int  $amount
     * @return Collection|Product[]
     */
    public function getTopProducts($amount = 8)
    {
        $configRepository = app(ConfigRepository::class);
        $ttl = $configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::PRODUCT_CACHE_TAGS
        ])->remember('products_top', $ttl, function () use ($amount) {
            return Product::limit($amount)->get();
        });
    }
}
