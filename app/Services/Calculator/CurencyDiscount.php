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

    /**
     * Рассчитывает скидку на группу товаров в корзине
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    public function getGroupDiscount(Discount $discount, float $price): float
    {
        if ($price - $discount->value < 1) {
            return $price - 1;
        }

        return $discount->value;
    }
}
