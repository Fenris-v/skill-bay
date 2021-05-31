<?php

namespace App\View\Components\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class HotItem extends Component
{
    /**
     * @var Category
     */
    public $category;

    /**
     * Create a new component instance.
     *
     * @param  Category  $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.categories.hot-item');
    }
}
