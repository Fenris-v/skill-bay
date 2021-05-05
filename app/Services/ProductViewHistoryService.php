<?php

namespace App\Services;

use App\Contracts\ProductViewHistoryService as ProductViewHistoryServiceContract;
use App\Models\Product;
use App\Models\User;
use App\Repository\ProductViewHistoryRepository;
use Illuminate\Support\Collection;

/**
 * Класс-сервис, который отвечает за историю просмотров товаров.
 */
class ProductViewHistoryService implements ProductViewHistoryServiceContract
{
    public function __construct(
        public ProductViewHistoryRepository $history,
        protected ?User $user
    ) {
    }

    /**
     * Добавление товара в список просмотренных товаров.
     *
     * @param Product $product
     * @return bool
     */
    public function add(Product $product): bool
    {
        if (!$this->user) {
            return false;
        }

        return $this->history->add($product->id, $this->user->id);
    }

    /**
     * Возвращает коллекцию просмотренных товаров.
     *
     * @return  Collection
     */
    public function get(): Collection
    {
        return $this->history->get($this->user->id);
    }

    /**
     * Возвращает количество просмотренных товаров.
     * @return  int
     */
    public function count(): int
    {
        return $this->history->count($this->user->id);
    }
}
