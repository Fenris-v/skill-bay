<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    const INT_TYPE = 1;
    const STRING_TYPE = 2;
    const CHECKBOX_TYPE = 3;
    const WYSIWYG_TYPE = 4;

    const CONFIG = 1;
    const INFO = 2;

    public $timestamps = false;

    protected $fillable = ['slug', 'type_id', 'value', 'content_type'];

    protected $casts = [
        'value' => 'string'
    ];

    public function scopeType(Builder $query, int $type = self::CONFIG)
    {
        $query->where('content_type', $type);
    }
}
