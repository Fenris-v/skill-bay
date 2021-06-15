<?php

namespace App\View\Components\Cart;

use App\Services\DiscountService;
use Illuminate\View\Component;
use App\Services\ProductCartService;

class HeaderCart extends Component
{
    public int $amount;
    public string $link;
    public float $price;

    public function __construct(
        ProductCartService $productCartService,
        DiscountService $discountService
    ) {
        $this->link = route('cart.show');
        $this->amount = $productCartService->count();
        $products = $productCartService->get();
        $this->price = (float) $discountService->getCartTotal(
            $products,
            $discountService->getCartDiscount($products)
        );
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
