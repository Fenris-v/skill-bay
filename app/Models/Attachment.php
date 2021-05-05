<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Attachment\Models\Attachment as OrchidAttachment;
use App\Traits\CacheFlushableAfterCRUDModelTrait;

class Attachment extends OrchidAttachment
{
    use HasFactory,
        CacheFlushableAfterCRUDModelTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
