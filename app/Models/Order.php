<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory,
        SoftDeletes,
        AsSource;

    /**
     * @var string[]
     */
    protected $fillable = [
        'cart_id', 'user_id', 'delivery_type_id',
        'city', 'address', 'payment_type_id',
    ];

    /**
     * Считает цену заказа с учетом скидки
     * @return float
     */
    public function getPriceWithoutDiscountAttribute(): float
    {
        return $this->price + $this->discount;
    }

    protected $fillable = [
        'city',
        'address',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @return BelongsTo
     */
    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
