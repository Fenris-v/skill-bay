<?php

namespace App\Orchid\Layouts\Banner;

use App\Models\Banner;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BannerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'banners';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.banner.list.table.id')),
            TD::make('title', __('admin.banner.list.table.title'))
                ->render(function (Banner $banner) {
                    return Link::make($banner->title)
                        ->route('platform.banner.edit', $banner);
                }),
        ];
    }
}
