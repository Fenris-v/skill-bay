<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Collection;
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
     * @return Collection|ProductReview[]
     */
    public function getReviews(Product $product)
    {
        // @todo Реализовать метод

        return $product->reviews;
    }

    /**
     * Получить количество отзывов для товара.
     *
     * @param  Product  $product
     * @return int
     */
    public function getReviewCount(Product $product)
    {
        return $this->getReviews($product)->count();
    }
}
