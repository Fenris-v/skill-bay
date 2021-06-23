<?php

namespace App\View\Components\Account;

use App\Models\Order;
use App\Repository\OrdersRepository;
use App\Services\DiscountService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderItem extends Component
{
    public bool $isPaid;
    public ?string $payError = null;
    public float $priceOld;
    public float $price;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Order $order,
        OrdersRepository $orders,
        DiscountService $service
    ) {
        $this->isPaid = $orders->getPaymentStatus($this->order);

        if (!$this->isPaid) {
            $this->payError = $orders->getErrorMessage($this->order);
        }

        $products = $order->cart->products;
        $this->price = $service->getCartTotal($products);
        $this->priceOld = $order->cart->oldPrice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.account.order-item');
    }
}
