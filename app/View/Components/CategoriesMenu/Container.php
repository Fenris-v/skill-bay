<?php

namespace App\View\Components\CategoriesMenu;

use Illuminate\View\Component;
use App\Models\Category;

class Container extends Component
{
    public $roots;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roots = Category::get()->toTree();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.categories-menu.container');
    }
}
