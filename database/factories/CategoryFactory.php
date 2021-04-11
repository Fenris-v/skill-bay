<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Image;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        $slug = \Str::slug($name);

        return [
            'slug' => $slug,
            'name' => $name,
            'image_id' => Image::factory(),
        ];
    }
}
