<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param  Category  $category
     * @return void
     * @throws \Exception
     */
    public function creating(Category $category)
    {
        // Автоматически создаем уникальный Slug.
        $category->slug = $category->generateUniqueSlug(
            $category->slug ?? \Str::slug($category->name)
        );
    }
}
