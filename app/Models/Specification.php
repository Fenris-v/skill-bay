<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
    ];

    public function group()
    {
        return $this->belongsTo(SpecificationGroup::Class, 'specification_group_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
