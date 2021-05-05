<?php

namespace App\Models;

use App\Traits\CacheFlushableAfterCRUDModelTrait;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Models\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CacheFlushableAfterCRUDModelTrait;
    use AsSource;
    use Sluggable;

    const PRODUCT_CACHE_TAGS = 'catalog';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'vendor',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Аксессор для получения средней цены
     * @return float
     */
    public function getAveragePriceAttribute(): float
    {
        return $this->sellers->avg('pivot.price') ?? 0;
    }

    /**
     * Выборка по продавцу
     * @param Builder $query
     * @param string $seller
     * @return Builder
     */
    public function scopeSeller(Builder $query, string $seller): Builder
    {
        return $query->whereHas(
            'sellers',
            function ($query) use ($seller) {
                return $query->where('title', $seller);
            }
        );
    }

    /**
     * Связь с категорией
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->withPivot('price');
    }

    /**
     * @return BelongsToMany
     */
    public function specifications()
    {
        return $this->belongsToMany(Specification::class)->withPivot('value');
    }

    /**
     * @return float
     */
    public function getCurrentPriceAttribute(): float
    {
        return $this->averagePrice - $this->discount * $this->averagePrice / 100;
    }

    /**
     * @return BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(
            Attachment::class,
            'image_product',
            null,
            'image_id'
        );
    }

    /**
     * Связь с главной картинкой
     * @return BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'main_image_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
