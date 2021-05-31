<?php

namespace App\Orchid\Layouts\Discount;

use App\Models\Discount;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DiscountListLayout extends Table
{
    /**
     * Data source.
     * @var string
     */
    protected $target = 'discounts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.discount.list.table.id')),
            TD::make('title', __('admin.discount.list.table.title'))
                ->render(fn(Discount $discount) => Link::make($discount->title)
                        ->route('platform.discount.edit', $discount)
                )
            ,
            TD::make('description', __('admin.discount.list.table.description')),
            TD::make('begin_at', __('admin.discount.list.table.begin_at')),
            TD::make('end_at', __('admin.discount.list.table.end_at')),
            TD::make('value', __('admin.discount.list.table.value'))
                ->render(
                    fn(Discount $discount) =>
                        $discount->value . __('admin.discount.unit_types.' . $discount->unit_type)
                )
            ,
            TD::make('unit_type', __('admin.discount.list.table.type'))
                ->render(fn(Discount $discount) => __('admin.discount.types.' . $discount->type))
            ,
            TD::make('priority', __('admin.discount.list.table.priority')),
        ];
    }
}
