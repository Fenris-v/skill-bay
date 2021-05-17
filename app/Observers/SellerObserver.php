<?php

namespace App\Observers;

use App\Models\Seller;

class SellerObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param  Seller  $seller
     * @return void
     * @throws \Exception
     */
    public function creating(Seller $seller)
    {
        // Автоматически создаем уникальный Slug.
        $seller->slug = $seller->generateUniqueSlug(
            $seller->slug ?? \Str::slug($seller->title)
        );
    }
}
