<?php

namespace App\Orchid\Screens\Config;

use App\Models\Admin\Config;
use App\Orchid\Layouts\Config\ConfigCacheLayout;
use App\Orchid\Layouts\Config\ConfigRowsLayout;
use Orchid\Support\Facades\Layout;

class ConfigsEditScreen extends ConfigScreen
{
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
        return [
            'configs' => Config::type()->get()
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs(
                [
                    __('admin.config.groups.config') => [ConfigRowsLayout::class],
                    __('admin.config.groups.cache') => [ConfigCacheLayout::class],
                ]
            )
        ];
    }
}
