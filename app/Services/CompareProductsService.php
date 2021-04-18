<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CompareProductsService
{

    private $products;

    public function __construct()
    {
        $this->products = Product::factory()->count(5)->make();
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function add(Product $product) : CompareProductsService
    {
        $this->products->push($product);
        return $this;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function remove(Product $product) : CompareProductsService
    {
        if ($key = $this->products->search($product)) {
            $this->products->forget($key);
        }

        return $this;
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function getProducts($count = 3) : Collection
    {
        return $this->products->take($count);
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return $this->products->count();
    }
}
