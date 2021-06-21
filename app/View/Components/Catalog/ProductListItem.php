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
    public bool $hideDetails = false;

    /**
     * Create a new component instance.
     *
     * @param  DiscountService  $service
     * @param  Product  $product
     * @param  Discount|null  $discount
     * @param  bool  $hideDetails
     */
    public function __construct(
        DiscountService $service,
        public Product $product,
        ?Discount $discount,
        bool $hideDetails = false,
    ) {
        $this->discount = $discount ?? null;

        if ($this->discount) {
            $this->price = $service->calculateDiscountPrice(
                $product,
                $this->discount,
                $product->avg_price
            );
        } else {
            $this->price = $product->avg_price;
        }

        $this->hideDetails = $hideDetails;
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
