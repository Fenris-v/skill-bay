<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Pivots\ProductSeller;
use App\Models\Order;
use App\Traits\CacheFlushableAfterCRUDModelTrait;

class Cart extends Model
{
    use HasFactory,
        SoftDeletes,
        CacheFlushableAfterCRUDModelTrait
    ;

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'cart_product_seller')
            ->join('product_seller', fn ($join) =>
                $join
                    ->on('products.id', '=', 'product_seller.product_id')
                    ->on('cart_product_seller.seller_id', '=', 'product_seller.seller_id')
                )
            ->select('products.*', 'product_seller.price', 'cart_product_seller.amount')
            ->using(ProductSeller::class)
            ->withPivot('seller_id')
        ;
    }

    public function sellers(): BelongsToMany
    {
        return $this
            ->belongsToMany(Seller::class, 'cart_product_seller')
            ->using(ProductSeller::class)
            ->withPivot('amount', 'product_id')
        ;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function getCurrentPriceAttribute(): float
    {
        return $this->products->reduce(
            fn($accum, $product) => $accum + ($product->price - $product->discount) * $product->amount,
            0
        );
    }

    public function getOldPriceAttribute(): float
    {
        return $this->products->reduce(
            fn($accum, $product) => $accum + $product->price * $product->amount,
            0
        );
    }
}
