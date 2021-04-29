<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\Seller;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductRepository
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class SellerRepository
{
    private ConfigRepository $configRepository;
    private int $ttl;

    public function __construct()
    {
        $this->configRepository = app(ConfigRepository::class);
        $this->ttl = $this->configRepository->getCacheLifetime(now()->addDay());
    }

    /**
     * Метод для получения продавца товара по его слагу
     * @param Product $product
     * @param string $slug
     * @return Seller
     */
    public function getSellerBySlugFromProduct(
        Product $product,
        string $slug
    ): Seller {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::class,
            Seller::class,
        ])->remember(
            'seller|' . $slug . '|of_product|' . $product->slug,
            $this->ttl,
            fn() => Seller
                ::where('slug', $slug)
                ->whereHas(
                    'products',
                    fn(Builder $query) => $query->where('slug', $product->slug)
                )
                ->firstOrFail()
        );
    }
}