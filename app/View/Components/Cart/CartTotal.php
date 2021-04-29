<?php

namespace App\View\Components\Cart;

use Illuminate\View\Component;
use App\Repository\CartRepository;

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
