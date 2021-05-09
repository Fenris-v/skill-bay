<?php

namespace App\Orchid\Screens\Order;

use Alert;
use App\Models\Cart;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\Attachment;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
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
     * Query data.
     *
     * @param  Order  $order
     * @return array
     */
    public function query(Order $order): array
    {
        $this->name = __(
            'admin.order.edit.title',
            ['id' => $order->id]
        );

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
     * @throws BindingResolutionException
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Relation::make('order.user_id')
                    ->required()
                    ->title(__('admin.order.edit.labels.user'))
                    ->fromModel(User::class, 'name'),
                Relation::make('order.delivery_type_id')
                    ->required()
                    ->title(__('admin.order.edit.labels.delivery_type'))
                    ->fromModel(DeliveryType::class, 'name'),
                Relation::make('order.payment_type_id')
                    ->required()
                    ->title(__('admin.order.edit.labels.payment_type'))
                    ->fromModel(PaymentType::class, 'name'),
                Input::make('order.city')
                    ->required()
                    ->title(__('admin.order.edit.labels.city')),
                TextArea::make('order.address')
                    ->required()
                    ->title(__('admin.order.edit.labels.address')),
                Relation::make('order.cart_id')
                    ->required()
                    ->title(__('admin.order.edit.labels.cart'))
                    ->fromModel(Cart::class, 'id'),
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
