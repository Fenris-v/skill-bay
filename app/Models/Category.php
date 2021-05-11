<?php

namespace App\Models;

use App\Traits\Models\Sluggable;
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

    public $timestamps = false;

    protected $fillable = [
        'name',
        'icon',
        'parent_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
