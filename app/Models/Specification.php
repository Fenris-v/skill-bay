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

    protected $fillable = [
        'title',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('value');
    }
}
