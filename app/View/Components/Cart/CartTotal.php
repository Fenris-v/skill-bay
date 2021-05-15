<?php

namespace App\View\Components\Cart;

use App\Repository\CartRepository;
use Illuminate\View\Component;

class CartTotal extends Component
{
    public float $currentTotal;
    public float $oldTotal;

    public function __construct(CartRepository $cartRepository)
    {
        $cart = $cartRepository->getCart();
        $this->currentTotal = $cart->currentPrice;
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
