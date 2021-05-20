<?php

namespace App\Models\Pivots;

use App\Models\Product;
use App\Traits\Models\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Seller;

class ProductSeller extends Pivot
{
    use HasCompositePrimaryKey;

    public $incrementing = false;

    protected $primaryKey = ['product_id', 'seller_id'];

    public $timestamps = false;

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Связь с родительским продуктом
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
