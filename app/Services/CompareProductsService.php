<?php


namespace App\Services;

use App\Models\Product;
use App\Models\Visitor;
use App\Repository\ConfigRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\CompareProductRepository;
use Cache;

class CompareProductsService
{
    private $compareProductRepository;
    private $configRepository;
    private $visitorService;

    /**
     * @param CompareProductRepository $compareProductRepository
     */
    public function __construct(
        CompareProductRepository $compareProductRepository,
        ConfigRepository $configRepository,
        VisitorService $visitorService
    )
    {
        $this->compareProductRepository = $compareProductRepository;
        $this->configRepository = $configRepository;
        $this->visitorService = $visitorService;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function add(Product $product) : bool
    {
        if (!$this->compareProductRepository->contains($product->id)) {
            $this->compareProductRepository->add($product);
            Cache::tags(CompareProductRepository::COMPARE_PRODUCT_CACHE_TAGS)->flush();
            return true;
        }

        return false;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function remove(Product $product) : bool
    {
        if ($this->compareProductRepository->contains($product->id)) {
            $this->compareProductRepository->remove($product);
            Cache::tags(CompareProductRepository::COMPARE_PRODUCT_CACHE_TAGS)->flush();
            return true;
        }

        return false;
    }

    /**
     * @param int $count
     * @return Collection|Array
     */
    public function getProducts($count = 3) : Collection|Array
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            CompareProductRepository::COMPARE_PRODUCT_CACHE_TAGS,
            Product::PRODUCT_CACHE_TAGS,
            Visitor::VISITOR_CACHE_TAGS,
        ])->remember('compare_products_visitor_' . $this->visitorService->get()->id, $ttl, function() use ($count) {
            return $this
                ->compareProductRepository
                ->get($count);
        });

    }

    /**
     * @return int
     */
    public function count() : int
    {
        $ttl = $this->configRepository->getCacheLifetime(now()->addDay());

        return Cache::tags([
            Visitor::VISITOR_CACHE_TAGS,
            CompareProductRepository::COMPARE_PRODUCT_CACHE_TAGS,
        ])->remember('compare_product_count_visitor_' . $this->visitorService->get()->id, $ttl, function() {
            return $this
                ->compareProductRepository
                ->count();
        });
    }

}
