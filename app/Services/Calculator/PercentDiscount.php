<?php

namespace App\Services\Calculator;

use App\Contracts\DiscountCalculator;
use App\Models\Discount;

class PercentDiscount implements DiscountCalculator
{
    /**
     * Рассчитывает цену со скидкой в процентах
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    public function getPrice(Discount $discount, float $price): float
    {
        return $price - ($price * ($discount->value / 100));
    }

    /**
     * Рассчитывает скидку на группу товаров в корзине
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    public function getGroupDiscount(Discount $discount, float $price): float
    {
        return $price * ($discount->value / 100);
    }
}
