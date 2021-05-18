<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductFiltersLayout;
use App\Orchid\Layouts\Product\ProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ProductListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.product.list.title';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'admin.product.list.description';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'products' => Product::with(['category', 'image'])
                ->filters()
                ->defaultSort('rating_sort')
                ->filtersApplySelection(ProductFiltersLayout::class)
                ->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('admin.product.list.buttons.add'))
                ->icon('plus')
                ->href(route('platform.product.create')),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            ProductFiltersLayout::class,
            ProductListLayout::class,
        ];
    }

    /**
     * Удаление продукта
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Product::findOrFail($request->get('id'))
            ->delete();

        Toast::error(__('admin.products.deleted'));
    }
}
