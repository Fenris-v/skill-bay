<?php

namespace App\Models;

use App\Models\Pivots\ProductSeller;
use App\Traits\CacheFlushableAfterCRUDModelTrait;
use App\Traits\Models\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    use AsSource;
    use Sluggable;
    use SoftDeletes;
    use CacheFlushableAfterCRUDModelTrait;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'icon',
        'parent_id',
        'is_hot',
        'hot_order',
        'image_id',
    ];

    protected $casts = [
        'is_hot' => 'boolean',
    ];

    const CATEGORY_CACHE_TAGS = 'category';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function productSellers()
    {
        return $this->hasManyThrough(
            ProductSeller::class,
            Product::class
        );
    }

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeHot(Builder $query)
    {
        return $query->where('is_hot', true);
    }
}
