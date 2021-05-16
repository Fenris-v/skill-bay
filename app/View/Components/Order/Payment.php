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
        $order = $ordersRepository->getCurrentOrder();
        $this->payments = PaymentType
            ::all()
            ->map(fn($item) => [
                'title' => $item->name,
                'value' => $item->id,
                'checked' => $order->paymentType?->id === $item->id,
            ])
            ->toArray()
        ;
    }

    public function render()
    {
        return view('components.order.payment');
    }
}
