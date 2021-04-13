<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
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
