<?php


namespace App\Contracts;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductReviewService
{
    /**
     * Добавить отзыв к товару.
     *
     * @param  Product  $product
     * @param  string  $name
     * @param  string  $email
     * @param  string  $comment
     * @return ProductReview
     */
    public function addReview(
        Product $product,
        string $name,
        string $email,
        string $comment
    );

    /**
     * Возвращает список отзывов к товару.
     *
     * @param  Product  $product
     * @return LengthAwarePaginator
     */
    public function getReviewListPaginator(Product $product);

    /**
     * Получить количество отзывов для товара.
     *
     * @param  Product  $product
     * @return int
     */
    public function getReviewCount(Product $product);
}
