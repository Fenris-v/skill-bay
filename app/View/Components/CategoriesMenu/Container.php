<?php

namespace App\View\Components\CategoriesMenu;

use App\Repository\CategoryRepository;
use Illuminate\View\Component;
use App\Models\Category;

class Container extends Component
{
    /**
     * @var
     */
    public $roots;

    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->roots = $this->categoryRepository->getTree();
        return view('components.categories-menu.container');
    }
}
