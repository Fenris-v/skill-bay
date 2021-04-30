<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
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
        $categories = Category::get('id');

        return [
            'title' => $title = ucfirst($this->faker->unique()->words(3, true)),
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence,
            'vendor' => ucfirst($this->faker->word),
            'rating_sort' => $this->faker->numberBetween(1, 999),
            'category_id' => $this->faker->randomElement($categories)->id,
            'created_at' => $this->faker->dateTimeBetween('-60 days', now()),
            'main_image_id' => Image::factory()
        ];
    }
}
