<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pivots\ProductSeller;

class Cart extends Model
{
    use HasFactory,
        SoftDeletes;

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'cart_product_seller')
            ->using(ProductSeller::class)
            ->withPivot('amount', 'seller_id')
        ;
    }

    public function sellers(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, 'cart_product_seller')->withPivot('amount');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
