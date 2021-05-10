<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ProductReview extends Model
{
    use HasFactory;
    use AsSource;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'comment', 'product_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
