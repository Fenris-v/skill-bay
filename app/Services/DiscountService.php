<?php


namespace App\Services;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class DiscountService
{
    /**
     * @param Collection $products
     * @return Collection $discounts
     */
    public function getDiscounts(Collection $products)
    {
        return Discount::factory()->count(rand(0, $products->count()))->make();
    }

    /**
     * @param Collection $products
     * @return Discount $discount
     */
    public function getPriorityDiscount(Collection $products)
    {
        return Discount::factory()->make();
    }

    /**
     * @param Product $product
     * @param float $price
     * @return float
     */
    public function getDiscountPrice(Product $product, float $price = null)
    {
        if (!isset($price)) {
            $price = $product->price;
        }

        return $price * rand(1, 99) / 100;
    }
}

/*
получить все скидки на указанный список товаров, или на один товар;
получить приоритетную скидку на указанный список товаров, или на один товар;
рассчитать цену со скидкой на товар, с дополнительным необязательным параметром - цена товара.
*/
