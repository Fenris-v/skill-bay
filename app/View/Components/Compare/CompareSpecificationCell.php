<?php

namespace App\View\Components\Compare;

use App\Models\Specification;
use Illuminate\View\Component;

class CompareSpecificationCell extends Component
{
    public $product;
    public $specificationTitle;
    public $specificationValue;
    public bool $isCheckbox;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product, $title)
    {
        $this->product = $product;
        $this->specificationTitle = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //Если продукт не имеет данной спецификации, устанавливается значение '-'
        $this->specificationValue = $this
                ->product
                ->specifications
                ->where('title', $this->specificationTitle)
                ->first()
                ->pivot
                ->value ?? '-';

        $this->isCheckbox = $this->product
                ->specifications
                ->where('title', $this->specificationTitle)
                ->first()
                ->type === Specification::CHECKBOX;

        return view('components.compare.compare-product');
    }
}
