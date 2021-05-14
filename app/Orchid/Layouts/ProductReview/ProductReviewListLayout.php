<?php

namespace App\Orchid\Layouts\ProductReview;

use App\Models\ProductReview;
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
        ];
    }
}
