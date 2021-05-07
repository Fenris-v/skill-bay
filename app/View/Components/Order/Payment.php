<?php

namespace App\View\Components\Order;

use App\Models\PaymentType;
use Illuminate\View\Component;

class Payment extends Component
{
    public array $payments;

    public function __construct()
    {
        $this->payments = PaymentType
            ::all()
            ->map(fn($item) => [
                'title' => $item->name,
                'value' => $item->id,
                'checked' => true,
            ])
            ->toArray()
        ;
    }

    public function render()
    {
        return view('components.order.payment');
    }
}
