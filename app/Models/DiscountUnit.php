<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountUnit extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
}
