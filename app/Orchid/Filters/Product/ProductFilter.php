<?php

namespace App\Orchid\Filters\Product;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class ProductFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['category'];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('admin.categories');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->when(
            $this->request->get('category'),
            function (Builder $query) {
                $query->whereHas(
                    'category',
                    function (Builder $query) {
                        $query->where('slug', $this->request->get('category'));
                    }
                );
            }
        );
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Select::make('category')
                ->fromModel(Category::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('category'))
                ->title(__('admin.categories'))
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . Category::where('slug', $this->request->get('category'))->first()->name;
    }
}
