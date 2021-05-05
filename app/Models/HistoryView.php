<?php

namespace App\Models;

use App\Traits\Models\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HistoryView extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;

    public $incrementing = false;

    protected $primaryKey = ['product_id', 'user_id'];

    protected $fillable = ['user_id', 'product_id', 'updated_at'];

    /**
     * Выборка по id пользователя
     * @param Builder $query
     * @param int $userId
     */
    public function scopeByUser(Builder $query, int $userId)
    {
        $query->where('user_id', $userId);
    }

    /**
     * Связь с товарами
     * @return HasOne
     */
    public function products(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
