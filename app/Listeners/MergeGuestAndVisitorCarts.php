<?php

namespace App\Listeners;

use App\Services\ProductCartService;
use App\Services\VisitorService;

class MergeGuestAndVisitorCarts
{
    public function __construct(
        public ProductCartService $cartService,
        public VisitorService $visitorService
    ) {}

    public function handle()
    {
        $this->cartService->mergeGuestAndUserCarts(
            $this->visitorService->getGuest(),
            $this->visitorService->get()
        );
    }
}
