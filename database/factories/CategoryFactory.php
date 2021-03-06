<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
        $slug = Str::slug($name);
        $icons = [
            "blender",
            "camera",
            "discount",
            "headphones",
            "lamp",
            "microwave",
            "smartphone",
            "soundbar",
            "stove",
            "teapot",
            "tv",
            "washing_machine"];

        return [
            'slug' => $slug,
            'name' => $name,
            'icon' => $icons[rand(0, count($icons) - 1)],
            'is_hot' => $this->faker->boolean,
            'hot_order' => $this->faker->numberBetween(0, 100),
            'image_id' => Attachment::factory(),
        ];
    }
}
