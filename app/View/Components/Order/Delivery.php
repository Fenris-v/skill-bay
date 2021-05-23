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
        $this->deliveries = $this->order->deliveryTypes->toArray();
    }

    public function render()
    {
        return view('components.order.delivery');
    }
}
