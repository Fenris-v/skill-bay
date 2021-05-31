<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class DiscountUnit extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Связь со скидкой
     * @return HasOne
     */
    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    /**
     * Связь наборов с продуктами
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(
            Product::class,
            'unitable',
            'discount_unitables',
            'unit_id'
        );
    }

    /**
     * Связь наборов с категориями
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphedByMany(
            Category::class,
            'unitable',
            'discount_unitables',
            'unit_id'
        );
    }
}
