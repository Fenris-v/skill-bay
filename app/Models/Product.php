<?php

namespace App\Models;

use App\Traits\Models\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
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

    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->withPivot('price');
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class)->withPivot('value');
    }
}
