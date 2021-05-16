<?php

namespace App\Services;

use App\Models\Product;

class LimitedEditionService
{
    public function get($count = 16)
    {
        return Product::where('limited', 1)
            ->where('daily_offer', 0)
            ->inRandomOrder()
            ->take($count)
            ->get();
    }
}
