<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Alert;

class CategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.category.edit.title_create';

    /**
     * @var bool
     */
    public $exists;

    /**
     * @var Category
     */
    private $category;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): array
    {
        $this->exists = $category->exists;
        if ($this->exists) {
            $this->name = __(
                'admin.category.edit.title_edit',
                ['name' => $category->name]
            );

            $this->category = $category;
        }
        return compact('category');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.category.edit.buttons.create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make(__('admin.category.edit.buttons.edit'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
            Button::make(__('admin.category.edit.buttons.remove'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('category.name')
                    ->required()
                    ->title(__('admin.category.edit.labels.name')),
                Input::make('category.icon')
                    ->required()
                    ->title(__('admin.category.edit.labels.icon')),
                Select::make('category.parent_id')
                    ->empty(__('admin.category.edit.labels.parent_empty'), 0)
                    ->fromQuery(Category::when($this->exists, function($query) {
                            $query
                                ->whereNotDescendantOf($this->category)
                                ->where('id', '!=', $this->category->id);
                        }),'name')
                    ->title(__('admin.category.edit.labels.parent')),
                CheckBox::make('category.is_hot')
                    ->required()
                    ->sendTrueOrFalse()
                    ->placeholder(__('admin.category.edit.labels.is_hot')),
                Input::make('category.hot_order')
                    ->title(__('admin.category.edit.labels.hot_order'))
                    ->type('number')
                    ->min(0)->max(2)
                    ->help(__('admin.category.edit.labels.hot_order_tip')),
            ]),
        ];
    }

    public function createOrUpdate(Category $category, Request $request)
    {
        $request->validate([
            'category.hot_order' => ['nullable', 'numeric', 'min:0', 'max:2'],
        ]);

        $category->fill($request->get('category'))->save();

        Alert::info(
            __(
                $category->wasRecentlyCreated
                    ? 'admin.category.edit.success'
                    : 'admin.category.edit.success_edit',
                ['name' => $category->name]
            )
        );

        return redirect()->route('platform.category.list');
    }

    public function remove(Category $category)
    {
        $category->delete();

        Alert::info(
            __('admin.category.edit.remove_edit', ['name' => $category->name])
        );

        return redirect()->route('platform.category.list');
    }
}
