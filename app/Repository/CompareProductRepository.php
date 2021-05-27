<?php

namespace App\Repository;

use App\Models\Attachment;
use App\Models\Specification;
use App\Models\Visitor;
use App\Services\VisitorService;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\ConfigRepository;
use App\Models\Seller;
use Cache;

class CompareProductRepository
{
    private $configRepository;

    const COMPARE_PRODUCT_CACHE_TAGS = 'compare_product';

    /**
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @param Visitor $visitor
     * @param Product $product
     */
    public function add(Visitor $visitor, Product $product)
    {
        $visitor->compareProducts()->attach($product);
        Cache::tags(self::COMPARE_PRODUCT_CACHE_TAGS)->flush();
    }

    /**
     * @param Visitor $visitor
     * @param Product $product
     */
    public function remove(Visitor $visitor, Product $product)
    {
        $visitor->compareProducts()->detach($product);
        Cache::tags(self::COMPARE_PRODUCT_CACHE_TAGS)->flush();
    }

    /**
     * @param Visitor $visitor
     * @param int $id
     * @return bool
     */
    public function contains(Visitor $visitor, int $id): bool
    {
        return $visitor->compareProducts->contains($id);
    }

    /**
     * @param Visitor $visitor
     * @return int
     */
    public function count(Visitor $visitor): int
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            Visitor::VISITOR_CACHE_TAGS,
            self::COMPARE_PRODUCT_CACHE_TAGS,
        ])->remember('compare_product_count_visitor_' . $visitor->id, $ttl, function() use ($visitor) {
            return $visitor
                ->compareProducts
                ->count();
        });
    }

    /**
     * @param Visitor $visitor
     * @param $count
     * @return Collection
     */
    public function get(Visitor $visitor, $count): Collection
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            self::COMPARE_PRODUCT_CACHE_TAGS,
            Product::PRODUCT_CACHE_TAGS,
            Visitor::VISITOR_CACHE_TAGS,
            Specification::class,
            Seller::class,
            Attachment::class,
        ])->remember(
            'compare_products_visitor_' . $visitor->id . '_count_' . $count,
            $ttl,
            function() use ($visitor, $count) {
            return $visitor
                ->compareProducts()
                ->take($count)
                ->with([
                    'image',
                    'specifications',
                    'sellers'
                ])
                ->get();
        });
    }
}
