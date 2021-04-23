<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(10),
            'url' => '/#',
            'is_active' => 1,
            'image_id' => Image::factory(),
        ];
    }
}
