<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,
        SoftDeletes;

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
