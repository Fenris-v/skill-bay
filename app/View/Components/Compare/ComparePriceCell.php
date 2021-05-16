<?php

namespace App\View\Components\Compare;

use App\Models\Product;
use App\Services\DiscountService;
use Illuminate\View\Component;

class ComparePriceCell extends Component
{
    public $discountService;
    public $product;
    public $price;
    public $discountPrice;

    public function __construct(Product $product, DiscountService $discountService)
    {
        $this->product = $product;
        $this->discountService = $discountService;
    }

    public function render()
    {
        $this->price = $this->product->averagePrice;
        $this->discountPrice = $this->discountService->getDiscountPrice($this->product);

        return view('components.compare.compare-price-cell');
    }
}
