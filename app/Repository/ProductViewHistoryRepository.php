<?php

namespace App\Repository;

use App\Models\HistoryView;
use Illuminate\Support\Collection;

class ProductViewHistoryRepository
{
    public int $historySize;

    public function __construct(public ConfigRepository $configs)
    {
        $this->historySize = $this->configs->getHistorySize();
    }

    /**
     * Добавление товара в список просмотренных товаров.
     * @param int $productId
     * @param int $userId
     * @return bool
     */
    public function add(int $productId, int $userId): bool
    {
        if ($this->updateInHistory($productId, $userId)) {
            return true;
        }

        $added = HistoryView::create(
            [
                'product_id' => $productId,
                'user_id' => $userId
            ]
        );

        $count = $this->count($userId);

        if ($count > $this->historySize) {
            $this->remove($count - $this->historySize, $userId);
        }

        return $added->exists();
    }

    /**
     * Возвращает коллекцию просмотренных товаров.
     *
     * @param $userId
     * @return  Collection
     */
    public function get($userId): Collection
    {
        return HistoryView::with('products')
            ->byUser($userId)
            ->latest('updated_at')
            ->get()
            ->pluck('products');
    }

    /**
     * Возвращает количество просмотренных товаров.
     * @param int $userId
     * @return  int
     */
    public function count(int $userId): int
    {
        return HistoryView::byUser($userId)->count() ?? 0;
    }

    /**
     * Удаление товара из списка просмотренных товаров.
     *
     * @param int $count
     * @param int $userId
     * @return bool
     */
    private function remove(int $count, int $userId)
    {
        return HistoryView::byUser($userId)
            ->orderBy('updated_at')
            ->take($count)
            ->delete();
    }

    /**
     * Проверяет добавлен ли продукт в избранное и обновляет его, если он есть
     * @param int $productId
     * @param int $userId
     * @return bool
     */
    private function updateInHistory(int $productId, int $userId): bool
    {
        $history = HistoryView::byUser($userId)
            ->where('product_id', $productId)
            ->first();

        if (!$history) {
            return false;
        }

        return $history->touch();
    }
}
