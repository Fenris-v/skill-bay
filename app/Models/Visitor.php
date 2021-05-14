<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
    ];

    /**
     * Товары в списке сравнения
     * @return BelongsToMany
     */
    public function compareProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'compare_product_visitor')->withTimestamps();
    }

    /**
     * Связь с зарегистрированным пользователем
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
