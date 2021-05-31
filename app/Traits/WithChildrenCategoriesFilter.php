<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

trait WithChildrenCategoriesFilter
{
    /**
     * Фильтрует по категории
     * @param Builder $query
     * @param Category $category
     * @return Builder
     */
    private function withChildrenCategoriesFilter(Builder $query, Category $category)
    {
        $categoryIds = [$category->id];
        $categoryIds = array_merge($categoryIds, $category->children()->pluck('id')->toArray());
        return $query->whereIn('category_id', $categoryIds);
    }
}
