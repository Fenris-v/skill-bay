<?php

namespace App\Models;

use App\Traits\Models\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CacheFlushableAfterCRUDModelTrait;
use Orchid\Screen\AsSource;

class Seller extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CacheFlushableAfterCRUDModelTrait;
    use AsSource;
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'phone',
        'email',
        'address',
        'image_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->using(\App\Models\Pivots\ProductSeller::class)->withPivot('price');
    }

    public function topProducts()
    {
        return $this->products()
            ->withCount('payedOrders')
            ->orderByDesc('payed_orders_count')
            ->limit(8);
    }

    public function image()
    {
        return $this->belongsTo(Attachment::class);
    }
}
