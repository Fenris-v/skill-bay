<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class ProductTypeDiscountListener
{
    const VALUE = Discount::PRODUCT;
    const MIN_GROUP_AMOUNT = 1;

    public function layouts(): array
    {
        return [$this->getProductsAndCategoriesSelect(0)];
    }

    protected function getProductsAndCategoriesSelect($id): Rows
    {
        return Layout::rows([
            Relation::make("discount.discountUnit.$id.products")
                ->fromModel(Product::class, 'title')
                ->multiple()
                ->title(__('admin.discount.chooseProducts')),
            Relation::make("discount.discountUnit.$id.categories")
                ->fromModel(Category::class, 'name')
                ->multiple()
                ->title(__('admin.discount.chooseCategories')),
        ]);
    }
}
