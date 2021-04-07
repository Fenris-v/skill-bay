<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    const INT_TYPE = 1;
    const STRING_TYPE = 2;
    const CHECKBOX_TYPE = 3;

    public $timestamps = false;

    protected $fillable = ['value'];

    protected $casts = [
        'value' => 'string'
    ];
}
