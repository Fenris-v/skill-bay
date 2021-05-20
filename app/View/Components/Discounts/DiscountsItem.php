<?php

namespace App\View\Components\Discounts;

use App\Models\Discount;
use Illuminate\View\Component;
use Illuminate\Support\Carbon;

class DiscountsItem extends Component
{
    public array|null $beginAt;
    public array|null $endAt;

    public function __construct(public Discount $discount)
    {
        $this->beginAt = $discount->begin_at ? $this->getDateArray($discount->begin_at) : null;
        $this->endAt = $discount->end_at ? $this->getDateArray($discount->end_at) : null;
    }

    protected function getDateArray(Carbon $date): array
    {
        return [
            'day' => $date->format('d'),
            'month' => $date->format('m'),
        ];
    }

    public function render()
    {
        return view('components.discounts.discounts-item');
    }
}
