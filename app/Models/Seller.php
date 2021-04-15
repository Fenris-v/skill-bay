<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CacheFlushableAfterCUDModelTrait;

class Seller extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CacheFlushableAfterCUDModelTrait;

    protected $fillable = [
        'title',
        'description',
        'phone',
        'email',
        'address',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
