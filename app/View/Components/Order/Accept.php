<?php

namespace App\View\Components\Order;

use App\Repository\OrdersRepository;
use App\Services\ProductCartService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use App\Models\Order;

class Accept extends Component
{
    public Order $order;
    public Collection $products;

    public function __construct(
        OrdersRepository $ordersRepository,
        ProductCartService $productCartService
    ) {
        $this->order = $ordersRepository->getCurrentOrder();
        $this->products = $productCartService->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order.accept');
    }
}
