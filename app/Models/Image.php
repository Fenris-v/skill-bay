<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * Возвращает URL изображения.
     *
     * @return string
     */
    public function getUrl()
    {
        // $this->path должен содержать относительный путь
        // от папки /storage/app/public/images/
        return \Storage::url(
            config('image.store_path') . $this->path
        );
    }
}
