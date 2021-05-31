<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class ProductGeneralLayout extends Rows
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
                    Input::make('product.title')
                        ->required()
                        ->title(__('admin.product.edit.labels.title')),

                    Input::make('product.vendor')
                        ->required()
                        ->title(__('admin.product.edit.labels.vendor')),
                ]
            ),

            SimpleMDE::make('product.description')
                ->title(__('admin.product.edit.description')),

            Group::make(
                [
                    Input::make('product.rating_sort')
                        ->required()
                        ->title(__('admin.product.list.table.rating_sort'))
                        ->type('number'),

                    Select::make('product.category_id')
                        ->required()
                        ->title(__('admin.product.edit.category'))
                        ->empty(__('admin.product.edit.no_category'))
                        ->fromModel(Category::class, 'name', 'id')
                ]
            ),

            Cropper::make('product.main_image_id')
                ->targetId()
                ->title(__('admin.product.edit.image')),

            Upload::make('product.attachment')
                ->title(__('admin.product.edit.images'))
        ];
    }
}
