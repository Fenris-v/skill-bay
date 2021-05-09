<?php

namespace App\Orchid\Screens\Banner;

use Alert;
use App\Models\Banner;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BannerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.banner.edit.title_create';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param  Banner  $banner
     * @return array
     */
    public function query(Banner $banner): array
    {
        $this->exists = $banner->exists;

        if($this->exists){
            $this->name = __(
                'admin.banner.edit.title_edit',
                ['title' => $banner->title]
            );
        }

        return compact('banner');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.banner.edit.buttons.create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->exists),

            Button::make(__('admin.banner.edit.buttons.edit'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make(__('admin.banner.edit.buttons.remove'))
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
                Input::make('banner.title')
                    ->required()
                    ->title(__('admin.banner.edit.labels.title')),
                Input::make('banner.description')
                    ->title(__('admin.banner.edit.labels.description')),
                Input::make('banner.url')
                    ->title(__('admin.banner.edit.labels.url')),
                Cropper::make('banner.image_id')
                    ->targetId()
                    ->title(__('admin.banner.edit.labels.image'))
                    ->width(735)
                    ->height(434),
            ]),
        ];
    }

    /**
     * @param  Banner  $banner
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Banner $banner, Request $request)
    {
        $banner->fill($request->get('banner'))->save();

        Alert::info(
            __(
                $banner->wasRecentlyCreated
                    ? 'admin.banner.edit.success_create'
                    : 'admin.banner.edit.success_edit',
                ['title' => $banner->title]
            )
        );

        return redirect()->route('platform.banner.list');
    }

    /**
     * @param Banner $banner
     *
     * @throws \Exception
     *@return \Illuminate\Http\RedirectResponse
     */
    public function remove(Banner $banner)
    {
        $banner->delete();

        Alert::info(
            __('admin.banner.edit.success_delete',
                ['title' => $banner->title])
        );

        return redirect()->route('platform.banner.list');
    }
}
