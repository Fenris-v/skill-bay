<?php

namespace App\Orchid\Screens\Config;

use App\Models\Admin\Config;
use App\Orchid\Layouts\Config\ConfigCacheLayout;
use App\Orchid\Layouts\Config\ConfigRowsLayout;
use App\Repository\ConfigRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $tags = [ConfigRepository::CONFIG_CACHE_TAGS];

        $configs = Config::all();
        foreach ($request->except('_token') as $key => $item) {
            $config = $configs->where('slug', $key)->first();

            if (!$config) {
                continue;
            }

            $this->validate($request, [$key => $this->getRules($config->type_id)]);

            $config->fill(['value' => $item]);

            if ($config->isDirty()) {
                if ($key === 'cache_lifetime') {
                    array_push($tags, ConfigRepository::GLOBAL_CACHE_TAG);
                }

                $wasUpdated = true;
                $config->save();
            }
        }

        if ($wasUpdated) {
            $this->cacheClear($tags);

            Toast::info(__('admin.config.toasts.save'));
        }

        return redirect()->route('platform.edit.config');
    }

    /**
     * Сбрасывает тэгированный кэш
     * @param array|string[] $tags
     * @return RedirectResponse
     */
    public function cacheClear(?array $tags): RedirectResponse
    {
        $tags = $tags ?? ConfigRepository::GLOBAL_CACHE_TAG;

        Cache::tags($tags)->flush();

        Toast::error(__('admin.config.toasts.cache'));

        return redirect()->route('platform.edit.config');
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
