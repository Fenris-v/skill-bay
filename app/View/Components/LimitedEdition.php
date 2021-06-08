<?php

namespace App\View\Components;

use App\Models\Product;
use App\Services\DiscountService;
use App\Services\LimitedEditionProductService;
use App\Traits\DiscountForProduct;
use Illuminate\View\Component;

class LimitedEdition extends Component
{
    use DiscountForProduct;

    /**
     * @var LimitedEditionProductService
     */
    private $limitedEditionProductService;

    /**
     * @var Product
     */
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        LimitedEditionProductService $limitedEditionProductService,
        DiscountService $discountService
    ) {
        $this->limitedEditionProductService = $limitedEditionProductService;
        $this->products = $this->limitedEditionProductService->get();
        $this->discounts = $discountService->getPriorityDiscount($this->products);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.limited-edition');
    }
}
