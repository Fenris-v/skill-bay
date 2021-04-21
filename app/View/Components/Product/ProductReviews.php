<?php

namespace App\View\Components\Product;

use App\Models\ProductReview;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductReviews extends Component
{
    /**
     * @var Collection|ProductReview[]
     */
    public $reviews;

    /**
     * Create a new component instance.
     *
     * @param  Collection  $reviews
     */
    public function __construct(Collection $reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.product.product-reviews');
    }
}
