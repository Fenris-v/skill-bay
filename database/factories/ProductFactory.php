<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = ucfirst($this->faker->unique()->words(3, true)),
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence,
            'vendor' => ucfirst($this->faker->word),
        ];
    }
}
