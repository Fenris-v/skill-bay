<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Image;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
