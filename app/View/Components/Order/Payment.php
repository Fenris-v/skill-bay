<?php

namespace App\View\Components\Order;

use App\Models\PaymentType;
use App\Repository\OrdersRepository;
use Illuminate\View\Component;

class Payment extends Component
{
    public array $payments;

    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->payments = $ordersRepository
            ->getCurrentOrder()
            ->paymentTypes
            ->toArray()
        ;
    }

    public function render()
    {
        return view('components.order.payment');
    }
}
