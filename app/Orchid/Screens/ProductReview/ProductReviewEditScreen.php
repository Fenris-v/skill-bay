<?php

namespace App\Orchid\Screens\ProductReview;

use Alert;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ProductReviewEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.product-review.edit.title_create';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param  ProductReview  $productReview
     * @return array
     */
    public function query(ProductReview $productReview): array
    {
        $this->exists = $productReview->exists;

        if ($this->exists) {
            $this->name = __('admin.product-review.edit.title_edit');
        }

        return compact('productReview');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.product-review.edit.buttons.save'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make(__('admin.product-review.edit.buttons.save'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('productReview.name')
                    ->required()
                    ->title(__('admin.product-review.edit.labels.name')),
                Input::make('productReview.email')
                    ->required()
                    ->type('email')
                    ->title(__('admin.product-review.edit.labels.email')),
                TextArea::make('productReview.comment')
                    ->required()
                    ->title(__('admin.product-review.edit.labels.comment')),
                Relation::make('productReview.product_id')
                    ->fromModel(Product::class, 'title')
                    ->title(__('admin.product-review.edit.select_product')),
            ]),
        ];
    }

    /**
     * @param  ProductReview  $productReview
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(ProductReview $productReview, Request $request)
    {
        $productReview->fill($request->get('productReview'))->save();

        Alert::info(
            __(
                $productReview->wasRecentlyCreated
                    ? 'admin.product-review.edit.success_create'
                    : 'admin.product-review.edit.success_edit',
                ['product' => $productReview->product->title]
            )
        );

        return redirect()->route('platform.product-review.list');
    }
}
