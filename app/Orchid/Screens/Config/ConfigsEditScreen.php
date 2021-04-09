<?php

namespace App\Orchid\Screens\Config;

use App\Models\Admin\Config;
use App\Orchid\Layouts\Config\ConfigCacheLayout;
use App\Orchid\Layouts\Config\ConfigRowsLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ConfigsEditScreen extends Screen
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

    public $configs;

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
            'configs' => Config::all()
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('admin.save'))
                ->method('save')
                ->icon('save-alt')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
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

    /**
     * Сохраняет изменения
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function save(Request $request): RedirectResponse
    {
        $wasUpdated = false;

        $configs = Config::all();
        foreach ($request->except('_token') as $key => $item) {
            $config = $configs->where('slug', $key)->first();

            if (!$config) {
                continue;
            }

            $this->validate($request, [$key => $this->getRules($config->type_id)]);

            $config->fill(['value' => $item]);

            if ($config->isDirty()) {
                $wasUpdated = true;
                $config->save();
            }
        }

        Toast::info(
            $wasUpdated
                ? __('admin.config.toasts.save')
                : __('admin.config.toasts.nothing')
        );

        return redirect()->route('platform.edit.config');
    }

    // TODO: написать метод для сброса кэша
    public function cacheClear()
    {
        Toast::error(__('admin.config.toasts.cache'));
    }

    /**
     * Возвращает набор правил в зависимости от типа поля
     * @param int $typeId
     * @return string
     */
    private function getRules(int $typeId): string
    {
        switch ($typeId) {
            case Config::INT_TYPE:
                return 'integer';
            case Config::STRING_TYPE:
                return 'string';
            case Config::CHECKBOX_TYPE:
                return 'boolean';
            default:
                return '';
        }
    }
}
