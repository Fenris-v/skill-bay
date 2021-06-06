<?php

namespace App\Models;

use App\Repository\DeliveryRepository;
use App\Repository\PaymentRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory,
        SoftDeletes,
        AsSource;

    /**
     * Статусы оплаты заказа.
     */
    public const PAYMENT_STATUS_NOT_PAYED = 0; // Не оплачен.
    public const PAYMENT_STATUS_PAYED = 1; // Оплачен.
    public const PAYMENT_STATUS_ERROR = -1; // Ошибка оплаты.

    /**
     * @var string[]
     */
    protected $fillable = [
        'cart_id', 'user_id', 'delivery_type_id',
        'city', 'address', 'payment_type_id',
        'phone', 'email', 'name', 'payment_status',
    ];

    /**
     * Считает цену заказа с учетом скидки
     * @return float
     */
    public function getPriceWithoutDiscountAttribute(): float
    {
        return $this->price + $this->discount;
    }

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

    /**
     * Получение способов доставки
     *
     * @return Collection|DeliveryType[]
     */
    public function getDeliveryTypesAttribute(): Collection
    {
        return app(DeliveryRepository::class)->getDeliveryTypes()
                ->map(fn($item) => [
                    'title' => $item->name . ($item->price ? " ($item->price$)" : ''),
                    'value' => $item->id,
                    'checked' => $this->delivery_type_id === $item->id,
            ])
        ;
    }

    /**
     * Получение способов оплаты
     *
     * @return Collection|PaymentType[]
     */
    public function getPaymentTypesAttribute(): Collection
    {
        return app(PaymentRepository::class)->getPaymentTypes()
                ->map(fn($item) => [
                    'title' => $item->name . ($item->price ? " ($item->price$)" : ''),
                    'value' => $item->id,
                    'checked' => $this->payment_type_id === $item->id,
            ])
        ;
    }
}
