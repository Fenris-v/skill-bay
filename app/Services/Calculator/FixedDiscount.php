<?php

namespace App\Services\Calculator;

use App\Contracts\DiscountCalculator;
use App\Models\Discount;

class FixedDiscount implements DiscountCalculator
{
    /**
     * Рассчитывает цену со скидкой в процентах
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    public function getPrice(Discount $discount, float $price = null): float
    {
        return $discount->value;
    }
}
