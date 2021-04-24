<?php

namespace App\View\Components\Cart;

use Illuminate\View\Component;
use App\Services\ProductCartService;

class CartTotal extends Component
{
    public float $currentTotal;
    public float $oldTotal;

    public function __construct(ProductCartService $productCartService)
    {
        $total = $productCartService->total();
        $this->currentTotal = $total['current'];
        $this->oldTotal = $total['old'];
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
