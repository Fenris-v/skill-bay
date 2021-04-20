<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Banner extends Model
{
    use HasFactory;
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'url',
        'image_id', 'is_active'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @param  Builder  $query
     * @param  bool  $active
     * @return Builder
     */
    public function scopeActive(Builder $query, $active = true)
    {
        return $query->where('is_active', $active);
    }
}
