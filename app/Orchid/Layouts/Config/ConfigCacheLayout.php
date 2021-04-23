<?php

namespace App\Orchid\Layouts\Config;

use App\Models\Product;
use App\Repository\ConfigRepository;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class ConfigCacheLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Group::make(
                [
                    Button::make(__('admin.config.cache.clear.all'))
                        ->method('cacheClear')
                        ->type(Color::ERROR()),

                    Button::make(__('admin.config.cache.clear.catalog'))
                        ->method('cacheClear')
                        ->type(Color::WARNING())
                        ->parameters([[Product::PRODUCT_CACHE_TAGS]]),

                    Button::make(__('admin.config.cache.clear.configs'))
                        ->method('cacheClear')
                        ->type(Color::WARNING())
                        ->parameters([[ConfigRepository::CONFIG_CACHE_TAGS]]),
                ]
            )
        ];
    }
}
