<?php

namespace App\View\Components\Discounts;

use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class DiscountsDate extends Component
{
    public int $day;
    public string $month;

    public function __construct(protected Carbon $date)
    {
        $this->day = $date->day;
        $this->month = $date->format('M');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.discounts.discounts-date');
    }
}
