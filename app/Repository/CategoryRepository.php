<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * Возвращает горячие категории.
     *
     * @param  int  $n
     * @return Collection
     */
    public function getHotCategories($n = 3)
    {
        return \Cache::tags([ConfigRepository::GLOBAL_CACHE_TAG])
            ->remember(
                'hot_categories',
                now()->addDay(),
                function () use ($n) {
                    /** @var Collection $categories */
                    $categories = Category::query()
                        ->hot()
                        ->withMin('productSellers', 'price')
                        ->take($n)
                        ->orderBy('hot_order')
                        ->get();

                    return $categories;
                }
            );
    }
}
