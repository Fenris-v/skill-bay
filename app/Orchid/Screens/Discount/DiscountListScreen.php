<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Discount;
use App\Orchid\Layouts\Discount\DiscountListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class DiscountListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.discount.list.title';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'admin.discount.list.description';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'discounts' => Discount::paginate(),
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
            Link::make(__('admin.discount.list.buttons.add'))
                ->icon('plus')
                ->href(route('platform.discount.create')),
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
            DiscountListLayout::class,
        ];
    }
}
