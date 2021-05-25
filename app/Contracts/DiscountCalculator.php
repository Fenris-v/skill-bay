<?php

namespace App\Contracts;

use App\Models\Discount;

interface DiscountCalculator
{
    /**
     * Рассчитывает цену со скидкой в процентах
     * @param Discount $discount
     * @param float $price
     * @return float
     */
    public function getPrice(Discount $discount, float $price): float;
}
