<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CacheFlushableAfterCRUDModelTrait;

class Specification extends Model
{
    use HasFactory,
        SoftDeletes,
        CacheFlushableAfterCRUDModelTrait
    ;

    const CHECKBOX = 1;
    const SELECT = 2;
    const MULTIPLE = 3;

    protected $fillable = [
        'title',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('value');
    }

    public function productSpecification()
    {
        return $this->hasManyThrough(ProductSpecification::class, Product::class);
    }

    public function values()
    {
        return $this->hasMany(ProductSpecification::class);
    }
}
