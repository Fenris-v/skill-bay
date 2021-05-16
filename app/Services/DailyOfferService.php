<?php

namespace App\Services;

use App\Models\Product;

class DailyOfferService
{
    /**
     * @var LimitedEditionService
     */
    public $limitedEditionService;

    /**
     * DailyOfferService constructor.
     * @param LimitedEditionService $limitedEditionService
     */
    public function __construct(LimitedEditionService $limitedEditionService)
    {
        $this->limitedEditionService = $limitedEditionService;
    }

    /**
     *Получение товара отмеченного как предложение дня
     *
     * @return Product
     */
    public function get()
    {
        return Product::where('daily_offer', 1)->first();
    }

    /**
     *Обновление предложения дня
     */
    public function update()
    {
        $currentOffer = $this->get();
        $newOffer = $this->limitedEditionService->all()->random();

        $currentOffer->daily_offer = 0;
        $newOffer->daily_offer = 1;

        $newOffer->save();
        $currentOffer->save();
    }
}
