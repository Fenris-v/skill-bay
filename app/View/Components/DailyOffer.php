<?php

namespace App\View\Components;

use App\Services\DiscountService;
use App\Services\LimitedEditionProductService;
use Carbon\Carbon;
use Illuminate\View\Component;

class DailyOffer extends Component
{

    /**
     * @var LimitedEditionProductService
     */
    private $limitedEditionProductService;

    /**
     * @var DiscountService
     */
    private $discountService;

    /**
     * @var \App\Models\Product
     */
    public $product;

    /**
     * @var Carbon
     */
    public $time;

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
        $this->discountService = $discountService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->time = Carbon::tomorrow();
        $this->product = $product = $this->limitedEditionProductService->getDailyOffer();

        $discount = $this->discountService->getPriorityDiscount($product)->first();

        $this->product->price = $discount
            ? $this->discountService
                ->calculateDiscountPrice(
                    $product,
                    $discount,
                    $product->averagePrice
                )
            : $product->averagePrice
        ;

        $this->product->priceOld = $product->averagePrice;

        return view('components.daily-offer');
    }
}
