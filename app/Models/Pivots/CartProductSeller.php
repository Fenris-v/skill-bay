<?php

namespace App\Models\Pivots;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartProductSeller extends Model
{
    use HasFactory;

    protected $table = 'cart_product_seller';

    /**
     * Связь с продавцом продукта в заказе/корзине
     * @return BelongsTo
     */
    public function productSeller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
