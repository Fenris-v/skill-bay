<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class ProductTypeDiscountLayout extends TypeDiscountLayout
{
    const VALUE = Discount::PRODUCT;
    const MIN_GROUP_AMOUNT = 1;

    public function layouts(): array
    {
        return [$this->getProductsAndCategoriesSelect(0)];
    }
}
