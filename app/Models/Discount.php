<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;
use DateTimeInterface;

class Discount extends Model
{
    use HasFactory;
    use AsSource;

    const PRODUCT = 1;
    const GROUP = 2;
    const CART = 3;

    const UNIT_PERCENT = 1;
    const UNIT_CURRENCY = 2;

    protected $dates = ['begin_at', 'end_at'];

    /**
     * Подготовить дату для отображения.
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y H:i:s');
    }

    /**
     * Связь с наборами
     * @return HasMany
     */
    public function discountUnit(): HasMany
    {
        return $this->hasMany(DiscountUnit::class);
    }

    /**
     * Связь с картинкой
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class, 'image_id');
    }
}
