<?php

namespace App\Repository;

use App\Models\Order;
use App\Services\OrderPaymentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdersRepository
{
    const PER_PAGE = 5;

    public function __construct(public OrderPaymentService $payment)
    {
    }

    /**
     * Возвращает объект заказа
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model
    {
        return Order::with(
            [
                'user',
                'deliveryType',
                'paymentType',
                'cart' => function ($query) {
                    $this->cart($query);
                }
            ]
        )->find($id);
    }

    /**
     * Возвращает историю заказов пользователя
     * @param int $userId
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getByUserId(int $userId, int $limit = self::PER_PAGE): LengthAwarePaginator
    {
        return $this->query($userId)->paginate($limit);
    }

    /**
     * @param int $userId
     * @return Model|null
     */
    public function getLast(int $userId): ?Model
    {
        return $this->query($userId)->first();
    }

    /**
     * Возвращает статус оплаты заказа
     * @param Order $order
     * @return bool
     */
    public function getPaymentStatus(Order $order): bool
    {
        return $this->payment->isPaid($order);
    }

    /**
     * Запрашивает текст ошибки у сервиса и возвращает его
     * @param Order $order
     * @return string
     */
    public function getErrorMessage(Order $order): string
    {
        return $this->payment->getErrorMessage($order);
    }

    /**
     * Связь с продуктами в заказе
     * @param BelongsTo $query
     */
    private function cart(BelongsTo $query)
    {
        $query->with(
            [
                'products' => function ($query) {
                    $query->with(
                        [
                            'image',
                            'cart' => function ($query) {
                                $query->with('productSeller');
                            }
                        ]
                    );
                }
            ]
        );
    }

    private function query(int $userId)
    {
        return Order::with(['deliveryType', 'paymentType'])
            ->where('user_id', $userId)
            ->latest();
    }
}
