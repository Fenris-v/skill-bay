<?php


namespace App\Services;
use App\Models\Product;

class CompareProductsService
{

    private $products;

    public function compare()
    {

    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product) : CompareProductsService
    {
        return $this;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function removeProduct(Product $product) : CompareProductsService
    {
        return $this;
    }

}
