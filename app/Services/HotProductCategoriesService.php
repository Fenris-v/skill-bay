<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\HotProductCategoriesService as HotProductCategoriesServiceContract;

class HotProductCategoriesService implements HotProductCategoriesServiceContract
{
    /**
     * Возвращает горячие категории.
     *
     * @return Collection
     */
    public function get()
    {
        return app(CategoryRepository::class)->getHotCategories();
    }
}
