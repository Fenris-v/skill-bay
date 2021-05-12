<?php

namespace App\View\Components\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class HotList extends Component
{
    /**
     * @var Collection|Category[]
     */
    public $hotCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct()
    {
        $this->hotCategories = Category::hot()->take(3)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.categories.hot-list');
    }
}
