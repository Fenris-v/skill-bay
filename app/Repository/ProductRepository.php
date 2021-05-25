<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Seller;
use App\Models\Specification;
use App\Traits\TimeToLiveCacheTrait;
use Cache;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class ProductRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {
    }

    /**
     * Возвращает топ товаров на главной странице.
     *
     * @param int $amount
     * @return Collection|Product[]
     */
    public function getTopProducts($amount = 8)
    {
        return Cache::tags(
            [
                ConfigRepository::GLOBAL_CACHE_TAG,
                Product::PRODUCT_CACHE_TAGS
            ]
        )->remember(
            'products_top',
            $this->ttl(),
            function () use ($amount) {
                return Product::limit($amount)
                    ->selectRaw(
                        '*, (SELECT AVG(price) FROM product_seller WHERE products.id = product_id) as avg_price'
                    )->get();
            }
        );
    }

    /**
     * Возвращает товар по его slug.
     *
     * @param Cart $cart
     * @param string $slug
     * @return Product
     */
    public function getProductBySlug(string $slug): Product
    {
        return Cache::tags(
            [
                ConfigRepository::GLOBAL_CACHE_TAG,
                Product::class,
                Seller::class,
                Specification::class,
                ProductReview::class,
            ]
        )->remember(
            'cart_product|' . $slug,
            $this->ttl(),
            fn() => Product
                ::where('slug', $slug)
                ->with(
                    [
                        'sellers',
                        'images',
                        'specifications',
                        'reviews',
                    ]
                )->firstOrFail()
        );
    }
}
