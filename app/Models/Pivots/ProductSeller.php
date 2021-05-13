<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductSeller extends Pivot
{
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class)
        ;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getPricesAttribute(): float
    {
        return $this->seller->products->firstWhere('id', $this->product->id)->pivot->price;
    }
}
