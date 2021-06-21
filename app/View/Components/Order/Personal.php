<?php

namespace App\View\Components\Order;

use App\Repository\OrdersRepository;
use Illuminate\View\Component;

class Personal extends Component
{
    public string $phone;
    public string $name;
    public string $email;

    public function __construct(OrdersRepository $ordersRepository)
    {
        $order = $ordersRepository->getCurrentOrder();
        $user = auth()->user();
        $getData = fn($param) => $order->$param ?? $user->$param ?? '';

        $this->phone = $getData('phone');
        $this->email = $getData('email');
        $this->name = $getData('name');


    }

    public function render()
    {
        return view('components.order.personal');
    }
}
