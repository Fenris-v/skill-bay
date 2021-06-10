<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Discount;
use Orchid\Screen\Layouts\Listener;

class TypeDiscountListener extends Listener
{
    protected $targets = [
        'discount.type',
        'discount.id',
        'amount',
    ];

    protected $asyncMethod = 'asyncChooseUnit';

    public static function getTypeClass(int $type): string
    {
        return match($type) {
            Discount::PRODUCT => ProductTypeDiscountLayout::class,
            Discount::GROUP => GroupTypeDiscountLayout::class,
            Discount::CART => CartTypeDiscountLayout::class,
        };
    }

    protected function layouts(): array
    {
        $type = self::getTypeClass($this->query->get('discount.type', Discount::PRODUCT));
        $unit = new $type(
            $this->query->get('discount'),
            $this->query->get('amount')
        );

        return $unit->layouts();
    }
}
