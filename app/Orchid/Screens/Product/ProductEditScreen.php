<?php

namespace App\Orchid\Screens\Product;

use Alert;
use App\Models\Pivots\ProductSeller;
use App\Models\Pivots\ProductSpecification;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Specification;
use App\Orchid\Layouts\Product\ProductGeneralLayout;
use App\Orchid\Layouts\Product\ProductSellersLayout;
use App\Orchid\Layouts\Product\ProductSpecificationsLayout;
use App\Orchid\Layouts\Product\SellersModalLayout;
use App\Orchid\Layouts\Product\SpecificationsModalLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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
     * @param string $product
     * @return array
     */
    public function query(string $product): array
    {
        $product = Product::where('slug', $product)
            ->with(['sellers', 'specifications'])
            ->first();

        $this->exists = $product->exists;

        if ($this->exists) {
            $this->name = __(
                'admin.product.edit.title_edit',
                ['title' => $product->title, 'id' => $product->id]
            );
        }

        return compact('product');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.product.edit.buttons.save'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make(__('admin.product.edit.buttons.save'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
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
            Layout::tabs(
                [
                    __('admin.product.general') => ProductGeneralLayout::class,
                    __('admin.product.sellers') => ProductSellersLayout::class,
                    __('admin.product.specifications') => ProductSpecificationsLayout::class
                ]
            ),

            Layout::modal('sellerModal', SellersModalLayout::class)
                ->title(__('admin.product.sellers_edit')),

            Layout::modal('specificationModal', SpecificationsModalLayout::class)
                ->title(__('admin.product.specifications_edit')),

            Layout::rows([
                Input::make('product.title')
                    ->required()
                    ->title(__('admin.product.edit.labels.title')),
                Input::make('product.vendor')
                    ->required()
                    ->title(__('admin.product.edit.labels.vendor')),
                CheckBox::make('product.limited')
                    ->value(0)
                    ->title(__('admin.product.edit.labels.limited'))
                    ->sendTrueOrFalse(),
            ]),
        ];
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return RedirectResponse
     */
    public function createOrUpdate(Product $product, Request $request): RedirectResponse
    {
        $product->fill($request->get('product'))->save();

        $product->images()->syncWithoutDetaching($request->input('product.attachment'));

        $this->syncPrices($product, $request->get('product')['price']);

        $this->syncSpecifications($product, $request->get('product')['specification']);

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

    /**
     * Изменяет перечень продавцов
     * @param Product $product
     * @param Request $request
     */
    public function saveSellers(Product $product, Request $request): void
    {
        $sellers = collect($request->get('product')['sellers'])
            ->keyBy(fn($item) => $item);

        $syncIds = [];

        foreach ($sellers as $seller) {
            $sellerObj = Seller::where('id', $seller)->first();

            $syncIds[] = $sellerObj->id;
        }

        $product->sellers()->sync($syncIds);

        Toast::info(__('admin.product.seller_added'));
    }

    /**
     * Изменяет перечень характеристик
     * @param Product $product
     * @param Request $request
     */
    public function saveSpecifications(Product $product, Request $request): void
    {
        $specifications = collect($request->get('product')['specifications'])
               ->keyBy(fn($item) => $item);

        $syncIds = [];

        foreach ($specifications as $specification) {
            $specificationObj = Specification::where('id', $specification)->first();

            $syncIds[] = $specificationObj->id;
        }

        $product->specifications()->sync($syncIds);

        Toast::info(__('admin.product.specification_edited'));
    }

    /**
     * Сохраняет цены
     * @param Product $product
     * @param array $prices
     */
    private function syncPrices(Product $product, array $prices): void
    {
        $sellersId = array_keys($prices);

        $relations = ProductSeller::where('product_id', $product->id)
            ->whereIn('seller_id', $sellersId)
            ->get();

        foreach ($relations as $relation) {
            $price = (float)$prices[$relation->seller_id];

            if ($relation->price === $price) {
                continue;
            }

            $relation->update(['price' => $price]);
        }
    }

    /**
     * Сохраняет характеристики
     * @param Product $product
     * @param array $specifications
     */
    private function syncSpecifications(Product $product, array $specifications): void
    {
        $specificationsId = array_keys($specifications);

        $relations = ProductSpecification::where('product_id', $product->id)
            ->whereIn('specification_id', $specificationsId)
            ->get();

        foreach ($relations as $relation) {
            if ($relation->value === $specifications[$relation->specification_id]) {
                continue;
            }

            $relation->update(['value' => $specifications[$relation->specification_id]]);
        }
    }
}
