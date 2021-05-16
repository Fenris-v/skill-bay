<?php

namespace App\View\Components;

use App\Services\DailyOfferService;
use Carbon\Carbon;
use Illuminate\View\Component;

class DailyOffer extends Component
{

    private $dailyOfferService;
    public $product;
    public $time;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DailyOfferService $dailyOfferService)
    {
        $this->dailyOfferService = $dailyOfferService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->time = Carbon::tomorrow();
        $this->product = $this->dailyOfferService->get();
        return view('components.daily-offer');
    }
}
