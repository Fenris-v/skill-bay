<?php

namespace App\View\Components\Order;

use App\Models\Order;
use Illuminate\View\Component;
use App\Models\DeliveryType;
use App\Repository\OrdersRepository;

class Delivery extends Component
{
    public array $deliveries;
    public Order $order;

    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->order = $ordersRepository->getCurrentOrder();
        $this->deliveries = DeliveryType
            ::all()
            ->map(fn($item) => [
                'title' => $item->name . ($item->price ? " ($item->price$)" : ''),
                'value' => $item->id,
                'checked' => $this->order->deliveryType?->id === $item->id,
            ])
            ->toArray()
        ;
    }

    public function render()
    {
        return view('components.order.delivery');
    }
}
