<?php

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Category;
use Orchid\Screen\Actions\Link;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.category.list.table.id')),
            TD::make('title', __('admin.category.list.table.title'))
                ->render(function(Category $category) {
                    return Link::make($category->name)
                        ->route('platform.category.edit', $category);
                }),
        ];
    }
}
