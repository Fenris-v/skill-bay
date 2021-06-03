<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use App\Models\Product;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class ProductsAndCategoriesLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        $fields = [
            Relation::make("discount.discountUnit.$id.products")
                ->fromModel(Product::class, 'title')
                ->multiple()
                ->title('Выберите товары'),
            Relation::make("discount.discountUnit.$id.categories")
                    ->fromModel(Category::class, 'name')
                    ->multiple()
                    ->title('Выберите категории'),
        ];

        return $fields;
    }
}
