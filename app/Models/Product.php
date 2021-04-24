<?php

namespace App\Models;

use App\Traits\CacheFlushableAfterCRUDModelTrait;
use App\Traits\Models\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->withPivot('price');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function specifications()
    {
        return $this->belongsToMany(Specification::class)->withPivot('value');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->latest();
    }

    /**
     * @return float
     */
    public function getCurrentPriceAttribute(): float
    {
        return $this->averagePrice - $this->discount * $this->averagePrice / 100;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
