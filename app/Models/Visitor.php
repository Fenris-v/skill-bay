<?php

namespace App\Models;

use App\Traits\CacheFlushableAfterCRUDModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Visitor extends Model
{
    use HasFactory;
    use CacheFlushableAfterCRUDModelTrait;

    const VISITOR_CACHE_TAGS = 'visitor';

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
