<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CategoryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.category.list.title';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'admin.category.list.description';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'categories' => Category::paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('admin.category.list.buttons.add'))
                ->icon('plus')
                ->href(route('platform.category.create')),
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
            CategoryListLayout::class,
        ];
    }

    /**
     * Удаление категории товаров.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Category::findOrFail($request->get('id'))
            ->delete();

        Toast::error(__('admin.category.was_deleted'));
    }
}
