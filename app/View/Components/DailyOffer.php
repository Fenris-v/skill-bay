<?php

namespace App\View\Components;

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
    public function __construct(LimitedEditionProductService $limitedEditionProductService)
    {
        $this->limitedEditionProductService = $limitedEditionProductService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->time = Carbon::tomorrow();
        $this->product = $this->limitedEditionProductService->getDailyOffer();
        return view('components.daily-offer');
    }
}
