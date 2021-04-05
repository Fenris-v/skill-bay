<?php

namespace App\Orchid\Screens\Config;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class ConfigEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description;

    public function __construct()
    {
        $this->name = __('admin.config.screen.edit.title');
        $this->description = __('admin.config.screen.edit.description');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.save'))
                ->method('save')
                ->icon('pencil')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
