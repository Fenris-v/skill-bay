<?php

namespace App\View\Components\Labels;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Discount as Model;

class Discount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Model $discount)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.labels.discount');
    }
}
