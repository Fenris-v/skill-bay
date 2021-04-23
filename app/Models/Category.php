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

    public function getIconUrl()
    {
        return config("image.icons_path") . 'departments/' . $this->icon . '.svg';
    }
}
