<?php

namespace App\Traits;

use App\Models\Discount;
use App\Models\Product;

trait DiscountForProduct
{
    public $discounts;

    /**
     * Возвращает скидку для товара
     * @param Product $product
     * @return Discount|null
     */
    public function getDiscount(Product $product): ?Discount
    {
        return $this->discounts->get($product->slug);
    }
}
