<?php

namespace App\Repository;

use App\Models\Admin\Config;
use Cache;
use Illuminate\Support\Collection;

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
     * @param mixed|null $default
     * @return mixed
     */
    public function getValueBySlug(string $slug, mixed $default = null): mixed
    {
        return $this->all()->where('slug', $slug)->first()->value ?? $default;
    }

    /**
     * Алиас, возвращающий facebook
     * @param string|null $default
     * @return string|null
     */
    public function getFacebook(?string $default = null): ?string
    {
        return $this->getValueBySlug('facebook', $default);
    }

    /**
     * Алиас, возвращающий linkedin
     * @param string|null $default
     * @return string|null
     */
    public function getLinkedin(?string $default = null): ?string
    {
        return $this->getValueBySlug('linkedin', $default);
    }

    /**
     * Алиас, возвращающий twitter
     * @param string|null $default
     * @return string|null
     */
    public function getTwitter(?string $default = null): ?string
    {
        return $this->getValueBySlug('twitter', $default);
    }

    /**
     * Алиас, возвращающий телефон
     * @param string|null $default
     * @return string|null
     */
    public function getPhone(?string $default = null): ?string
    {
        return $this->getValueBySlug('phone', $default);
    }

    /**
     * Алиас, возвращающий email
     * @param string|null $default
     * @return string|null
     */
    public function getEmail(?string $default = null): ?string
    {
        return $this->getValueBySlug('email', $default);
    }

    /**
     * Алиас, возвращающий страну
     * @param string|null $default
     * @return string|null
     */
    public function getCountry(?string $default = null): ?string
    {
        return $this->getValueBySlug('country', $default);
    }

    /**
     * Алиас, возвращающий страну
     * @param string|null $default
     * @return string|null
     */
    public function getRegion(?string $default = null): ?string
    {
        return $this->getValueBySlug('region', $default);
    }

    /**
     * Алиас, возвращающий страну
     * @param string|null $default
     * @return string|null
     */
    public function getCity(?string $default = null): ?string
    {
        return $this->getValueBySlug('city', $default);
    }

    /**
     * Алиас, возвращающий страну
     * @param string|null $default
     * @return string|null
     */
    public function getAddress(?string $default = null): ?string
    {
        return $this->getValueBySlug('address', $default);
    }

    /**
     * Алиас, возвращающий полный адрес
     * @param string|null $default
     * @return string|null
     */
    public function getFullAddress(?string $default = null): ?string
    {
        $address = [
            $this->getCountry() ?? null,
            $this->getRegion() ?? null,
            $this->getCity() ?? null,
            $this->getAddress() ?? null,
        ];

        $address = array_filter($address, function ($var) {
            return $var;
        });

        if (empty($address)) {
            return $default;
        }

        return implode(', ', $address);
    }

    /**
     * Алиас, возвращающий количество объектов на странице
     * @param int $default
     * @return int
     */
    public function getPerPage(int $default = 8): int
    {
        return $this->getValueBySlug('per_page', $default);
    }

    /**
     * Алиас, возвращающий количество объектов на странице
     * @param int $default
     * @return int
     */
    public function getHistorySize(int $default = 20): int
    {
        return $this->getValueBySlug('history_size', $default);
    }

    /**
     * Алиас, возвращающий время жизни кэша
     * @param mixed $default
     * @return int
     */
    public function getCacheLifetime($default = 86400): int
    {
        return $this->getValueBySlug('cache_lifetime', $default);
    }

    /**
     * Возвращает время жизни кэша и кеширует его с отдельным ключом
     * @return int
     */
    private function getLifetime(): int
    {
        if (Cache::tags([self::CONFIG_CACHE_TAGS, self::GLOBAL_CACHE_TAG])->has('configs_cache_lifetime')) {
            return Cache::tags([self::CONFIG_CACHE_TAGS, self::GLOBAL_CACHE_TAG])
                ->get('configs_cache_lifetime');
        }

        $lifetime = Config::where('slug', 'cache_lifetime')->first()->value ?? 86400;

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
