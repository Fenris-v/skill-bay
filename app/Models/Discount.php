<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    const PRODUCT = 1;
    const GROUP = 2;
    const CART = 3;

    const UNIT_PERCENT = 1;
    const UNIT_CURRENCY = 2;

    protected $dates = ['begin_at', 'end_at'];

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
