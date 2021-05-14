<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $table = 'product_specification';

    /**
     * Связь с товаром
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Связь с родительской характеристикой
     * @return BelongsTo
     */
    public function specification(): BelongsTo
    {
        return $this->belongsTo(Specification::class);
    }
}
