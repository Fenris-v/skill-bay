<?php

namespace App\Models\Pivots;

use App\Models\Product;
use App\Models\Specification;
use App\Traits\Models\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSpecification extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = ['product_id', 'specification_id'];

    protected $table = 'product_specification';

    protected $fillable = ['value'];

    /**
     * Связь с товаром
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Связь с родительской характеристикой
     * @return BelongsTo
     */
    public function specification(): BelongsTo
    {
        return $this->belongsTo(Specification::class);
    }
}
