<?php

namespace App\Listeners;

use App\Services\ProductCartService;
use App\Contracts\VisitorService;

class MergeGuestAndVisitorCarts
{
    public function __construct(
        protected ProductCartService $cartService,
        protected VisitorService $visitorService
    ) {}

    public function handle()
    {
        $this->cartService->mergeGuestAndUserCarts(
            $this->visitorService->getGuest(),
            $this->visitorService->get()
        );
    }
}
