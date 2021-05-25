<?php

namespace App\Repository;

use App\Models\DeliveryType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Traits\TimeToLiveCacheTrait;

class DeliveryRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {}

    /**
     * Получение способов доставки
     *
     * @return Collection|DeliveryType[]
     */
    public function getDeliveryTypes(): Collection
    {
        return Cache::tags([
            ConfigRepository::GLOBAL_CACHE_TAG,
            DeliveryType::class,
        ])->remember(
            'delivery_types',
            $this->ttl(),
            fn() => DeliveryType::all()
        );
    }
}
