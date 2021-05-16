<?php

namespace App\Orchid\Screens\Seller;

use App\Models\Seller;
use App\Orchid\Layouts\Seller\SellerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SellerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.seller.list.title';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'admin.seller.list.description';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'sellers' => Seller::paginate(),
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
            Link::make(__('admin.seller.list.buttons.add'))
                ->icon('plus')
                ->href(route('platform.seller.create')),
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
            SellerListLayout::class,
        ];
    }
}
