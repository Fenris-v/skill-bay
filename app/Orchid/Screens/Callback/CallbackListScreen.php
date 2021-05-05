<?php

namespace App\Orchid\Screens\Callback;

use App\Models\Callback;
use App\Orchid\Layouts\Callback\CallbackListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class CallbackListScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.callback.title');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'callbacks' => Callback::filters()
                ->defaultSort('created_at', 'desc')
                ->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            CallbackListLayout::class
        ];
    }
}
