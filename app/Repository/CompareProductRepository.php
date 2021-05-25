<?php

namespace App\Repository;

use App\Services\VisitorService;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CompareProductRepository
{
    private $visitorService;

    const COMPARE_PRODUCT_CACHE_TAGS = 'compare_product';

    /**
     * @param VisitorService $visitorService
     */
    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;
    }

    public function add(Product $product)
    {
        $this->visitorService->get()->compareProducts()->attach($product);
    }

    public function remove(Product $product)
    {
        $this->visitorService->get()->compareProducts()->detach($product);
    }

    public function contains(int $id): bool
    {
        return $this->visitorService->get()->compareProducts->contains($id);
    }

    public function count(): int
    {
        return $this->visitorService->get()->compareProducts->count();
    }

    public function get($count): Collection
    {
        return $this
            ->visitorService
            ->get()
            ->compareProducts
            ->take($count)
            ->load('image')
            ->load('specifications')
            ->load('sellers');


    }
}
