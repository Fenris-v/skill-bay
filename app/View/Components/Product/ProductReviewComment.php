<?php

namespace App\View\Components\Product;

use App\Models\ProductReview;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductReviewComment extends Component
{
    /**
     * @var ProductReview
     */
    public $review;

    /**
     * Create a new component instance.
     *
     * @param  ProductReview  $review
     */
    public function __construct(ProductReview $review)
    {
        $this->review = $review;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.product.product-review-comment');
    }
}
