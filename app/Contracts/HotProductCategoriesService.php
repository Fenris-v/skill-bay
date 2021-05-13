<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface HotProductCategoriesService
{
    /**
     * Возвращает горячие категории.
     *
     * @param  int  $n
     * @return Collection
     */
    public function get($n = 3);
}
