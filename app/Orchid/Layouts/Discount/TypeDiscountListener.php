<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Listener;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Accordion;

class TypeDiscountListener extends Listener
{
    protected $targets = [
        'discount.type',
        'discount.id',
        'amount',
    ];

    protected $asyncMethod = 'asyncChooseUnit';

    protected function layouts(): array
    {
        $layouts = [];
        $type = $this->query->get('type') ?? $this->query->get('discount')->type;
        $discountUnitsAmount = $this->query->get('discount')?->discountUnit()?->count();
        if ($this->query->has('amount')) {
            $amount = $this->query->get('amount');
        } else {
            $amount = $type === Discount::GROUP
                ? $discountUnitsAmount ?? 2
                : $discountUnitsAmount ?? 1
            ;
        }

        match($type) {
            Discount::PRODUCT => array_push($layouts, $this->getProductsAndCategoriesSelect(0)),
            Discount::GROUP => array_push(
                $layouts,
                $this->getAmountButtons($amount),
                $this->getAccordion($amount)
            ),
        Discount::CART => $this->getCartDiscountFields(),
        };

        return $layouts;
    }

    protected function getCartDiscountFields(): Rows
    {
        return Layout::rows([]);
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

    protected function getAccordion(int $amountElement): Accordion
    {
        $elements = [];
        for ($i = 0; $i < $amountElement; $i++) {
            $elements[__('admin.discount.group', ['number' => $i + 1])] = $this->getProductsAndCategoriesSelect($i);
        }

        return Layout::accordion($elements);
    }

    protected function getAmountButtons(int $amount): Rows
    {
        return Layout::rows([
            Input::make('amount')
                ->type('number')
                ->value($amount)
                ->id('changerAmount')
                ->title(__('admin.discount.changeAmountGroup')),
        ]);
    }
}
