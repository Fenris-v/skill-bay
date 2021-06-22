<?php

namespace App\View\Components\Compare;

use App\Models\Product;
use App\Services\DiscountService;
use App\Models\Discount;
use Illuminate\View\Component;

class ComparePriceCell extends Component
{
    public $discount;
    public $product;
    public $price;
    public $discountPrice;

    public function __construct(Product $product, DiscountService $discountService)
    {
        $this->product = $product;
        $this->discount = $discountService->getPriorityDiscount($product)->first();

        $this->price = $product->averagePrice;
        $this->discountPrice = $discountService->calculateDiscountPrice(
            $product,
            $this->discount,
            $product->averagePrice
        );
    }

    public function render()
    {
        return view('components.compare.compare-price-cell');
    }
}
