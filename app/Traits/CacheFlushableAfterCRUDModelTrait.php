<?php

namespace App\Traits;

trait CacheFlushableAfterCRUDModelTrait
{
    public static function bootCacheFlushableAfterCUDModelTrait()
    {
        $fnFlush = fn() => \Cache::tags([self::class])->flush();
        static::updated($fnFlush);
        static::created($fnFlush);
        static::deleted($fnFlush);
    }
}
