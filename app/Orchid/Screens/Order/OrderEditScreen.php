<?php

namespace App\Orchid\Screens\Order;

use Alert;
use App\Models\Order;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class OrderEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.order.edit.title';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param  Order  $order
     * @return array
     */
    public function query(Order $order): array
    {
        $this->exists = $order->exists;

        return compact('order');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.order.edit.buttons.edit'))
                ->icon('note')
                ->method('createOrUpdate'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                // @todo
            ]),
        ];
    }

    /**
     * @param  Order  $order
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Order $order, Request $request)
    {
        $order->fill($request->get('order'))->save();

        Alert::info(
            __(
                'admin.order.edit.success_edit',
                ['id' => $order->id]
            )
        );

        return redirect()->route('platform.order.list');
    }
}
