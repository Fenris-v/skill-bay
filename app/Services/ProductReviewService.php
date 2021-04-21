<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\ProductReviewService as ProductReviewServiceContract;

class ProductReviewService implements ProductReviewServiceContract
{
    /**
     * Добавить отзыв к товару.
     *
     * @param  Product  $product
     * @param  string  $name
     * @param  string  $comment
     * @return ProductReview
     */
    public function addReview(Product $product, string $name, string $comment)
    {
        $review = $product->reviews()->create([
           ''
        ]);

        return new ProductReview();
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
