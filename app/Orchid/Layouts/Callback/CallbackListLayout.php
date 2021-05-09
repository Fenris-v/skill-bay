<?php

namespace App\Orchid\Layouts\Callback;

use App\Models\Callback;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CallbackListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'callbacks';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', __('admin.callback.name'))
                ->render(
                    function (Callback $callback) {
                        return Link::make($callback->name)
                            ->route('platform.callback.show', $callback);
                    }
                )->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('email', __('admin.callback.email'))
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('created_at', __('admin.callback.created_at'))
                ->render(
                    function (Callback $callback) {
                        return $callback->fullDateFormat($callback->created_at);
                    }
                )->sort()
                ->width(50)
                ->align('center')
                ->filter(TD::FILTER_DATE),
        ];
    }
}
