<?php

namespace App\Orchid\Layouts\Seller;

use App\Models\Seller;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SellerListLayout extends Table
{
    /**
     * Data source.
     * @var string
     */
    protected $target = 'sellers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.seller.list.table.id')),
            TD::make('title', __('admin.seller.list.table.title'))->render(function(Seller $seller) {
                return Link::make($seller->title)
                    ->route('platform.seller.edit', $seller);
            }),
            TD::make('email', __('admin.seller.list.table.email')),
            TD::make('phone', __('admin.seller.list.table.phone')),
        ];
    }
}
