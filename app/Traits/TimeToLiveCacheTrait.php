<?php

namespace App\Traits;

trait TimeToLiveCacheTrait
{
    /**
     * Возвращает время жизни кэша.
     *
     * @return int
     */
    protected function ttl(): int
    {
        return $this->configRepository->getCacheLifetime(now()->addDay());
    }
}
