<?php

namespace App\Orchid\Screens\Callback;

use App\Models\Callback;
use Orchid\Screen\Action;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CallbackShowScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.callback.show');
    }

    /**
     * Query data.
     *
     * @param Callback $callback
     * @return array
     */
    public function query(Callback $callback): array
    {
        return [
            'callback' => $callback
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
            Layout::rows(
                [
                    Input::make('callback.name')
                        ->title(__('admin.callback.name')),
                    Input::make('callback.email')
                        ->title(__('admin.callback.email')),
                    TextArea::make('callback.message')
                        ->title(__('admin.callback.message'))
                        ->rows(8),
                ]
            )
        ];
    }
}
