<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\HotProductCategoriesService as HotProductCategoriesServiceContract;

class HotProductCategoriesService implements HotProductCategoriesServiceContract
{
    /**
     * Возвращает горячие категории.
     *
     * @param  int  $n
     * @return Collection
     */
    public function get($n = 3)
    {
        /** @var Collection $categories */
        $categories = Category::query()
            ->hot()
            ->withMin('productSellers', 'price')
            ->take($n)
            ->orderBy('hot_order')
            ->get();

        return $categories;
    }
}
