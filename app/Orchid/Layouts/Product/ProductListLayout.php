<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.products.id'))
                ->align(TD::ALIGN_CENTER)
                ->width(100)
                ->render(
                    function (Product $product) {
                        return view('platform.product-image', compact('product'));
                    }
                )->sort()
                ->filter(TD::FILTER_NUMERIC),

            TD::make('title', __('admin.product.list.table.title'))
                ->render(
                    function (Product $product) {
                        return Link::make($product->title)
                            ->route('platform.product.edit', $product);
                    }
                )->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('averagePrice', __('admin.product.list.table.avg_price'))
                ->align(TD::ALIGN_CENTER)
                ->render(
                    function (Product $product) {
                        $price = $product->averagePrice;
                        return view('platform.price', compact('price'));
                    }
                ),

            TD::make('rating_sort', __('admin.product.list.table.rating_sort'))
                ->align(TD::ALIGN_CENTER)
                ->sort(),

            TD::make('updated_at', __('admin.product.list.table.updated'))
                ->align(TD::ALIGN_CENTER)
                ->sort()
                ->render(
                    function (Product $product) {
                        return $product->updated_at->toDateTimeString();
                    }
                )->filter(TD::FILTER_DATE),

            TD::make(__('admin.actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(
                    function (Product $product) {
                        return $this->renderDropDown($product);
                    }
                ),
        ];
    }

    /**
     * Отрисовывает выпадающее меню
     * @param Product $product
     * @return DropDown
     */
    private function renderDropDown(Product $product): DropDown
    {
        return DropDown::make()
            ->icon('options-vertical')
            ->list(
                [
                    Link::make(__('admin.products.edit'))
                        ->route('platform.product.edit', $product->getRouteKey())
                        ->icon('pencil'),

                    Button::make(__('admin.products.delete'))
                        ->icon('trash')
                        ->method('remove')
                        ->confirm(' ')
                        ->parameters(
                            [
                                'id' => $product->id,
                            ]
                        ),
                ]
            );
    }
}
