<?php

namespace App\View\Components\Compare;

use Illuminate\View\Component;

class CompareRow extends Component
{
    public $title;
    public $specifications;
    public $products;
    public $isSameSpecification;

    public function __construct($specifications, $products)
    {
        $this->specifications = $specifications;
        $this->products = $products;
    }

    public function render()
    {
        $this->title = $this->specifications->first()->title;

        //Определение, являются ли все хоарактиристики одинаковыми
        $this->isSameSpecification =
            $this->specifications->count() == $this->products->count() &&
            $this->specifications->pluck('pivot.value')->unique()->count() == 1;

        return view('components.compare.compare-row');
    }
}
