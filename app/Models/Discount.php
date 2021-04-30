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

    /**
     * Связь с наборами
     * @return HasMany
     */
    public function discountUnit(): HasMany
    {
        return $this->hasMany(DiscountUnit::class);
    }
}
