<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Order;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [
            TD::make('id', __('admin.order.list.table.id')),
            TD::make('user', __('admin.order.list.table.supplier'))
                ->render(fn (Order $order) => Link::make("{$order->user->name} [ID: {$order->user->id}]")
                    ->route('platform.systems.users.edit', $order->user)),
            TD::make('delivery_type', __('admin.order.list.table.delivery_type'))
                ->render(fn (Order $order) => optional($order->deliveryType)->name),
            TD::make('address', __('admin.order.list.table.delivery_address'))
                ->render(fn (Order $order) => "$order->city, $order->address"),
            TD::make('payment_type', __('admin.order.list.table.payment_type'))
                ->render(fn (Order $order) => optional($order->paymentType)->name),
            TD::make('created_at', __('admin.order.list.table.created_at'))
                ->render(fn (Order $order) => $order->created_at->format('d.m.Y H:i')),
            TD::make('actions', __('admin.order.list.table.actions'))
                ->render(fn (Order $order) => Link::make(__('admin.order.list.buttons.show'))
                    ->route('platform.order.edit', $order)
                ),
        ];
    }
}
