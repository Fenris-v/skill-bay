<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Discount;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Accordion;

class GroupTypeDiscountListener extends ProductTypeDiscountListener
{
    const VALUE = Discount::GROUP;
    const MIN_GROUP_AMOUNT = 2;

    public function __construct(
        protected Discount $discount,
        protected int|null $amount,
    ) {}

    public function layouts(): array
    {
        $amount = $this->amount ?? $this->discount?->discountUnit()->count();
        if ($amount < self::MIN_GROUP_AMOUNT) {
            $amount = self::MIN_GROUP_AMOUNT;
        }

        return [
            $this->getAmountButtons($amount),
            $this->getAccordion($amount),
        ];
    }

    protected function getAccordion(int $amountElement): Accordion
    {
        $elements = [];
        for ($i = 0; $i < $amountElement; $i++) {
            $elements[__('admin.discount.group', ['number' => $i + 1])] = $this->getProductsAndCategoriesSelect($i);
        }

        return Layout::accordion($elements);
    }

    protected static function getAmountButtons(int $amount): Rows
    {
        return Layout::rows([
            Input::make('amount')
                ->type('number')
                ->value($amount)
                ->title(__('admin.discount.changeAmountGroup')),
        ]);
    }
}
