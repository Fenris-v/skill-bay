<?php

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
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
            TD::make(__('admin.actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(
                    function (Category $category) {
                        return $this->renderDropDown($category);
                    }
                ),
        ];
    }

    /**
     * Отрисовывает выпадающее меню.
     *
     * @param  Category  $category
     * @return DropDown
     */
    private function renderDropDown(Category $category): DropDown
    {
        return DropDown::make()
            ->icon('options-vertical')
            ->list(
                [
                    Link::make(__('admin.change'))
                        ->route('platform.category.edit', $category->getRouteKey())
                        ->icon('pencil'),

                    Button::make(__('admin.delete'))
                        ->icon('trash')
                        ->method('remove')
                        ->confirm(' ')
                        ->parameters(
                            [
                                'id' => $category->id,
                            ]
                        ),
                ]
            );
    }
}
