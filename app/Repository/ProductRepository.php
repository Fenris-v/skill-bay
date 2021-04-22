<?php

namespace App\Repository;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Seller;
use App\Models\Specification;
use App\Repository\ConfigRepository;
use Cache;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class ProductRepository
{
    private ConfigRepository $configRepository;
    private int $ttl;

    public function __construct()
    {
        $this->configRepository = app(ConfigRepository::class);
        $this->ttl = $this->configRepository->getCacheLifetime(now()->addDay());
    }

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

    /**
     * Возвращает товар по его slug.
     *
     * @param  int  $amount
     * @return Product
     */
    public function getProductBySlug(string $slug): Product
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            Product::class,
            Seller::class,
            Image::class,
            Specification::class,
            ProductReview::class,
        ])->remember(
            'product|' . $slug,
            $this->ttl,
            fn() => Product::with('sellers', 'images', 'specifications', 'reviews')
                ->where('slug', $slug)
                ->firstOrFail()
        );
    }
}
