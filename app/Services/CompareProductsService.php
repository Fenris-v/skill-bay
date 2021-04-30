<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CompareProductsService
{
    private $visitorService;

    /**
     * @param VisitorService $visitorService
     */
    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function add(Product $product) : bool
    {
        $compareProducts = $this->visitorService->get()->compareProducts();

        if (!$compareProducts->get()->contains($product)) {
            $compareProducts->attach($product);

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
        $compareProducts = $this->visitorService->get()->compareProducts();

        if ($compareProducts->findOrFail($product->id)) {
            $compareProducts->detach($product);

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
        return $this
            ->visitorService
            ->get()
            ->compareProducts
            ->load('images')
            ->load('specifications')
            ->take($count);
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return $this
            ->visitorService
            ->get()
            ->compareProducts
            ->count();
    }

}
