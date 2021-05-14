<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Contracts\ProductReviewService as ProductReviewServiceContract;
use Illuminate\Database\Eloquent\Model;

class ProductReviewService implements ProductReviewServiceContract
{
    /**
     * Добавить отзыв к товару.
     *
     * @param  Product  $product
     * @param  string  $name
     * @param  string  $email
     * @param  string  $comment
     * @return ProductReview|Model
     */
    public function addReview(
        Product $product,
        string $name,
        string $email,
        string $comment
    ) {
        return $product->reviews()->create(
            compact('name', 'email', 'comment')
        );
    }

    /**
     * Возвращает список отзывов к товару.
     *
     * @param  Product  $product
     * @return LengthAwarePaginator
     */
    public function getReviewListPaginator(Product $product)
    {
        return $product->reviews()->paginate(
            config('product.reviews_per_page')
        );
    }

    /**
     * Получить количество отзывов для товара.
     *
     * @param  Product  $product
     * @return int
     */
    public function getReviewCount(Product $product)
    {
        return $product->reviews()->count();
    }
}
