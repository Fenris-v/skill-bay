<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface HotProductCategoriesService
{
    /**
     * Возвращает горячие категории.
     *
     * @return Collection
     */
    public function get();
}
