<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Discount;
use Orchid\Support\Facades\Layout;

class CartTypeDiscountLayout extends TypeDiscountLayout
{
    const VALUE = Discount::CART;
    const MIN_GROUP_AMOUNT = 2;

    public function layouts(): array
    {
        return [Layout::rows([])];
    }
}
