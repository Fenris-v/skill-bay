<?php

namespace App\Orchid\Screens\ProductReview;

use App\Models\ProductReview;
use App\Orchid\Layouts\ProductReview\ProductReviewListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

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
            'productReviews' => ProductReview::with('product')->latest()->paginate(),
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

    /**
     * Удаление отзыва.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        ProductReview::findOrFail($request->get('id'))
            ->delete();

        Toast::error(__('admin.product-review.was_deleted'));
    }
}
