<?php

namespace App\Repository;

use App\Models\PaymentType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Traits\TimeToLiveCacheTrait;

class PaymentRepository
{
    use TimeToLiveCacheTrait;

    public function __construct(private ConfigRepository $configRepository)
    {}

    /**
     * Получение способов оплаты
     *
     * @return Collection|PaymentType[]
     */
    public function getPaymentTypes(): Collection
    {
        return Cache::tags([
                ConfigRepository::GLOBAL_CACHE_TAG,
                PaymentType::class,
            ])->remember(
                'payment_types',
                $this->ttl(),
                fn() => PaymentType::all()
        );
    }
}
