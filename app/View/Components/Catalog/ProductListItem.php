<?php

namespace App\View\Components\Catalog;

use App\Models\Discount;
use App\Models\Product;
use App\Services\DiscountService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductListItem extends Component
{
    public ?Discount $discount;
    public ?float $price = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DiscountService $service, public Product $product)
    {
        $this->discount = $service->getPriorityDiscount($this->product)->first();

        if ($this->discount) {
            $this->price = $service->calculateDiscountPrice(
                $product,
                $this->discount,
                $product->avg_price
            );
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.catalog.product-list-item');
    }
}
