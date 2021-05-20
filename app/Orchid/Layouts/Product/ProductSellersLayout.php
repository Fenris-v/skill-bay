<?php

namespace App\Orchid\Layouts\Product;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class ProductSellersLayout extends Rows
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
        $fields[] = ModalToggle::make(__('admin.product.sellers_edit'))
            ->modal('sellerModal')
            ->method('saveSellers')
            ->icon('shekel');

        foreach ($this->query->get('product.sellers') as $seller) {
            $fields[] = Input::make("product.price.$seller->id")
                ->title(__('admin.product.price', ['seller' => $seller->title]))
                ->required()
                ->value($seller->pivot->price);
        }

        return $fields;
    }
}
