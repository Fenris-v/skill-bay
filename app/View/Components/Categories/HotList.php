<?php

namespace App\View\Components\Categories;

use App\Contracts\HotProductCategoriesService;
use App\Models\Category;
use App\Repository\ConfigRepository;
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
     * @param  HotProductCategoriesService  $service
     * @throws \Exception
     */
    public function __construct(HotProductCategoriesService $service)
    {
        $this->hotCategories = \Cache::tags([ConfigRepository::GLOBAL_CACHE_TAG])
            ->remember(
                'hot_categories',
                now()->addDay(),
                function () use ($service) {
                    return $service->get();
                }
            );
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
