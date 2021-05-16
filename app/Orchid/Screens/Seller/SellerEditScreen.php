<?php

namespace App\Orchid\Screens\Seller;

use App\Models\Seller;
use Illuminate\Http\Request;
use Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SellerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'admin.seller.edit.title_create';

    public $exists;

    private $seller;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Seller $seller): array
    {
        $this->exists = $seller->exists;
        if ($this->exists) {
            $this->name = __('admin.seller.edit.title_edit', ['name' => $seller->title]);
            $this->seller = $seller;
        }

        return compact('seller');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.seller.edit.buttons.create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make(__('admin.seller.edit.buttons.save'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
            Button::make(__('admin.seller.edit.buttons.remove'))
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
//                'title' => 'Название',
//                'phone' => 'Номер телефона',
//                'email' => 'Адрес электронной почты',
//                'description' => 'Описание',
//                'address' => 'Адрес',
//                'image' => 'Логитип',
        return [
            Layout::rows([
            Input::make('seller.title')
                ->required()
                ->title(__('admin.seller.edit.labels.title')),
            Input::make('seller.phone')
                ->required()
                ->mask('+9 (999) 999-99-99')
                ->title(__('admin.seller.edit.labels.phone')),
            Input::make('seller.email')
                ->required()
                ->mask('*{1,20}@*{1,20}.*{2,4}')
                ->title(__('admin.seller.edit.labels.email')),
            TextArea::make('seller.description')
                ->rows(5)
                ->required()
                ->title(__('admin.seller.edit.labels.description')),
            Input::make('seller.address')
                ->required()
                ->title(__('admin.seller.edit.labels.address')),
            Cropper::make('seller.image_id')
                ->required()
                ->targetId()
                ->width(500)
                ->height(300)
                ->title('admin.seller.edit.labels.image')
            ]),
        ];
    }

    public function createOrUpdate(Seller $seller, Request $request)
    {

        $seller->fill($request->get('seller'))->save();

        Alert::info(
            __(
                $seller->wasRecentlyCreated
                    ? 'admin.seller.edit.success_create'
                    : 'admin.seller.edit.success_edit',
                ['name' => $seller->title]
            )
        );

        return redirect()->route('platform.seller.list');
    }

    public function remove(Seller $seller)
    {
        $seller->delete();

        Alert::info(
            __('admin.seller.edit.remove_edit', ['name' => $seller->name])
        );

        return redirect()->route('platform.seller.list');
    }
}
