<?php

namespace App\View\Components\Order;

use Illuminate\View\Component;
use App\Models\DeliveryType;
use App\Repository\OrderRepository;

class Delivery extends Component
{
    public array $deliveries;

    public function __construct()
    {
        $this->deliveries = DeliveryType
            ::all()
            ->map(fn($item) => [
                'title' => $item->name . ($item->price ? " ($item->price)" : ''),
                'value' => $item->id,
                'checked' => true,
            ])
            ->toArray()
        ;
    }

    public function render()
    {
        return view('components.order.delivery');
    }
}
