<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Seller;

class ProductSeller extends Pivot
{
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
