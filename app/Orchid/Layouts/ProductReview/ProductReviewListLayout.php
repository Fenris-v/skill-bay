<?php

namespace App\Orchid\Layouts\ProductReview;

use App\Models\ProductReview;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductReviewListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'productReviews';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.product-review.list.table.id')),
            TD::make('comment', __('admin.product-review.list.table.comment'))
                ->render(function (ProductReview $productReview) {
                    return Link::make(\Str::words($productReview->comment, 10))
                        ->route('platform.product-review.edit', $productReview);
                }),
            TD::make('product', __('admin.product-review.list.table.product'))
                ->render(fn (ProductReview $review) => Link::make("{$review->product->title} [ID: {$review->product->id}]")
                    ->route('products.show', $review->product)
                    ->target('_blank')
                ),
            TD::make(__('admin.actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(
                    function (ProductReview $review) {
                        return $this->renderDropDown($review);
                    }
                ),
        ];
    }

    /**
     * Отрисовывает выпадающее меню.
     *
     * @param  ProductReview  $review
     * @return DropDown
     */
    private function renderDropDown(ProductReview $review): DropDown
    {
        return DropDown::make()
            ->icon('options-vertical')
            ->list(
                [
                    Link::make(__('admin.change'))
                        ->route('platform.product-review.edit', $review->getRouteKey())
                        ->icon('pencil'),

                    Button::make(__('admin.delete'))
                        ->icon('trash')
                        ->method('remove')
                        ->confirm(' ')
                        ->parameters(
                            [
                                'id' => $review->id,
                            ]
                        ),
                ]
            );
    }
}
