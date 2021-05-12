<?php

namespace App\Orchid\Screens\Product;

use Alert;
use App\Models\Product;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.product.edit.title_create';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param  Product  $product
     * @return array
     */
    public function query(Product $product): array
    {
        $this->exists = $product->exists;

        if($this->exists){
            $this->name = __(
                'admin.product.edit.title_edit',
                ['title' => $product->title]
            );
        }

        return compact('product');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.product.edit.buttons.save'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->exists),

            Button::make(__('admin.product.edit.buttons.save'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
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
                Input::make('product.title')
                    ->required()
                    ->title(__('admin.product.edit.labels.title')),
                Input::make('product.vendor')
                    ->required()
                    ->title(__('admin.product.edit.labels.vendor')),
            ]),
        ];
    }

    /**
     * @param  Product  $product
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Product $product, Request $request)
    {
        $product->fill($request->get('product'))->save();

        Alert::info(
            __(
                $product->wasRecentlyCreated
                    ? 'admin.product.edit.success_create'
                    : 'admin.product.edit.success_edit',
                ['title' => $product->title]
            )
        );

        return redirect()->route('platform.product.list');
    }
}
