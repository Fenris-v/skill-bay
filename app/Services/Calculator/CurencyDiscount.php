<?php

namespace App\Services\Calculator;

use App\Contracts\DiscountCalculator;
use App\Models\Discount;

class CurencyDiscount implements DiscountCalculator
{
    /**
     * Рассчитывает цену со скидкой в валюте
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    public function getPrice(Discount $discount, float $price): float
    {
        if ($price - $discount->value < 1) {
            return 1;
        }

        return $price - $discount->value;
    }
}
