<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Specification;
use Illuminate\Contracts\Container\BindingResolutionException;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class SpecificationsModalLayout extends Rows
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
     * @throws BindingResolutionException
     */
    protected function fields(): array
    {
        return [
            Relation::make('product.specifications')
                ->fromModel(Specification::class, 'title')
                ->multiple()
        ];
    }
}
