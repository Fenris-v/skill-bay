<?php

namespace App\View\Components\Cart;

use Illuminate\View\Component;
use App\Services\ProductCartService;
use App\Repository\CartRepository;

class HeaderCart extends Component
{
    public int $amount;
    public string $link;
    public float $price;

    public function __construct(
        ProductCartService $productCartService,
        CartRepository $cartRepository
    ) {
        $this->link = route('cart.show');
        $this->amount = $productCartService->count();
        $this->price = $cartRepository->getCart()->currentPrice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart.header-cart');
    }
}
