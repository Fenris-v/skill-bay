<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\Seller;
use App\Repository\ConfigRepository;
use App\Traits\TimeToLiveCacheTrait;
use Cache;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductRepository
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class SellerRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {}

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
            $this->ttl(),
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