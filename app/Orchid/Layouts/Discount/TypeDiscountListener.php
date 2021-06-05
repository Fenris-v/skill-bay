<?php

namespace App\Orchid\Layouts\Discount;

use Orchid\Screen\Layouts\Listener;

class TypeDiscountListener extends Listener
{
    protected $targets = [
        'discount.type',
        'discount.id',
        'amount',
    ];

    protected $asyncMethod = 'asyncChooseUnit';

    protected function layouts(): array
    {
        $type = $this->query->get('type', ProductTypeDiscountListener::class);
        $unit = new $type(
            $this->query->get('discount'),
            $this->query->get('amount')
        );

        return $unit->layouts();
    }
}
