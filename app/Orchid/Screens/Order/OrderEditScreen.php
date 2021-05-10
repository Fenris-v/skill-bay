<?php

namespace App\Orchid\Screens\Order;

use Alert;
use App\Models\Cart;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\User;
use App\Orchid\Layouts\Order\OrderCartTable;
use App\View\Components\Order\OrchidOrderCartItems;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
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
     * @var Order
     */
    public Order $order;

    /**
     * Query data.
     *
     * @param  Order  $order
     * @return array
     */
    public function query(Order $order): array
    {
        $this->order = $order;

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
            Button::make(__('admin.order.edit.buttons.save'))
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
        $layout = [];

        if ($this->order->cart->products->isNotEmpty()) {
            $layout[] = Layout::table('order.cart.products', [
                TD::make('id', '№'),
                TD::make('title', __('admin.product.list.table.title'))->render(
                    fn (Product $product) => Link::make($product->title)
                        ->route('products.show', $product)
                        ->target('_blank')
                ),
                TD::make('seller', __('admin.product.list.table.seller'))
                    ->render(fn (Product $product) => optional($product->pivot->seller)->title),
                TD::make('amount', __('admin.product.list.table.amount'))
                    ->render(fn (Product $product) => $product->pivot->amount),
                TD::make('total_price', __('admin.product.list.table.total_price'))
                    ->render(fn (Product $product) => round($product->current_price * $product->pivot->amount)),
            ]);
        }

        $layout[] = Layout::rows([
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
        ]);

        return $layout;
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
