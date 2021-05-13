<?php

namespace App\Repository;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Seller;
use App\Models\Cart;
use App\Models\Specification;
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

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * Возвращает топ товаров на главной странице.
     *
     * @param  int  $amount
     * @return Collection|Product[]
     */
    public function getTopProducts($amount = 8)
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

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
     * @param Cart $cart
     * @param  string  $slug
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
            'cart_product|' . $slug,
            $this->configRepository->getCacheLifetime(now()->addDay()),
            fn() => Product
                ::where('slug', $slug)
                ->with([
                    'sellers',
                    'images',
                    'specifications',
                    'reviews',
                ])
                ->firstOrFail()
        );
    }
}
