<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Discount;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Group;

class CartTypeDiscountLayout extends TypeDiscountLayout
{
    const VALUE = Discount::CART;
    const MIN_GROUP_AMOUNT = 0;

    public function layouts(): array
    {
        $langKey = 'admin.discount.edit.conditions.';
        return [
            Layout::rows([
                Group::make([
                    Input::make('discount.conditions.min_price')
                        ->title(__($langKey . 'min_price'))
                    ,
                    Input::make('discount.conditions.max_price')
                        ->title(__($langKey . 'max_price'))
                    ,
                ]),
                Group::make([
                    Input::make('discount.conditions.min_amount')
                        ->title(__($langKey . 'min_amount'))
                    ,
                    Input::make('discount.conditions.max_amount')
                        ->title(__($langKey . 'max_amount'))
                    ,
                ]),
            ])
        ];
    }
}
