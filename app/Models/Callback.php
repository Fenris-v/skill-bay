<?php

namespace App\Models;

use App\Traits\TimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Callback extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use TimeFormat;

    protected $fillable = ['name', 'email', 'message'];

    protected $allowedSorts = [
        'name',
        'email',
        'created_at'
    ];

    protected $allowedFilters = [
        'name',
        'email',
        'created_at'
    ];
}
