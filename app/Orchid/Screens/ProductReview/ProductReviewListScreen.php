<?php

namespace App\Orchid\Screens\ProductReview;

use App\Models\ProductReview;
use App\Orchid\Layouts\ProductReview\ProductReviewListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProductReviewListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.product-review.list.title';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'admin.product-review.list.description';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'productReviews' => ProductReview::latest()->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('admin.product-review.list.buttons.add'))
                ->icon('plus')
                ->href(route('platform.product-review.create')),
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
            ProductReviewListLayout::class,
        ];
    }
}
