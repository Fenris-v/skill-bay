<?php

namespace App\Orchid\Screens\Banner;

use App\Models\Banner;
use App\Orchid\Layouts\Banner\BannerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BannerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.banner.list.title';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'admin.banner.list.description';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'banners' => Banner::paginate(),
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
            Link::make(__('admin.banner.list.buttons.add'))
                ->icon('plus')
                ->href(route('platform.banner.create')),
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
            BannerListLayout::class,
        ];
    }
}
