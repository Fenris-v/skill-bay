<?php

namespace App\Repository;

use App\Models\Admin\Config;
use Illuminate\Support\Collection;
use Cache;

class ConfigRepository
{
    const CONFIG_CACHE_TAGS = 'configs';
    const GLOBAL_CACHE_TAG = 'megano';

    /**
     * Возвращает коллекцию настроек
     * @return Collection
     */
    public function all(): Collection
    {
        return Cache::tags([self::CONFIG_CACHE_TAGS, self::GLOBAL_CACHE_TAG])
            ->remember(
                'configs',
                $this->getLifetime(),
                function () {
                    return Config::all();
                }
            );
    }

    /**
     * Выбирает из коллекции конкретную настройку и возвращает ее значение
     * @param string $slug
     * @param mixed $default
     * @return mixed
     */
    public function getValueBySlug(string $slug, $default = null)
    {
        return $this->all()->where('slug', $slug)->first()->value ?? $default;
    }

    /**
     * Алиас, возвращающий количество объектов на странице
     * @param mixed $default
     * @return mixed
     */
    public function getPerPage($default = null)
    {
        return $this->getValueBySlug('per_page', $default);
    }

    /**
     * Алиас, возвращающий время жизни кэша
     * @param mixed $default
     * @return mixed|null
     */
    public function getCacheLifetime($default = null)
    {
        return $this->getValueBySlug('cache_lifetime', $default);
    }

    /**
     * Возвращает время жизни кэша и кеширует его с отдельным ключом
     * @return array|mixed
     */
    private function getLifetime()
    {
        if (Cache::tags([self::CONFIG_CACHE_TAGS, self::GLOBAL_CACHE_TAG])->has('configs_cache_lifetime')) {
            return Cache::tags([self::CONFIG_CACHE_TAGS, self::GLOBAL_CACHE_TAG])
                ->get('configs_cache_lifetime');
        }

        $lifetime = Config::where('slug', 'cache_lifetime')->first()->value ?? 0;

        return Cache::tags([self::CONFIG_CACHE_TAGS, self::GLOBAL_CACHE_TAG])
            ->remember(
                'configs_cache_lifetime',
                $lifetime,
                function () use ($lifetime) {
                    return $lifetime;
                }
            );
    }
}
