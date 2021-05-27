<?php

namespace App\View\Components\Cart;

use App\Repository\CartRepository;
use App\Services\DiscountService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CartTotal extends Component
{
    public float $currentTotal;
    public float $oldTotal;

    public function __construct(
        CartRepository $cartRepository,
        Collection $discounts,
        DiscountService $service
    ) {
        $cart = $cartRepository->getCart();
        $this->currentTotal = $service->getCartTotal($cart->products, $discounts);
        $this->oldTotal = $cart->oldPrice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart.cart-total');
    }
}
