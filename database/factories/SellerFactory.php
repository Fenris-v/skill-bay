<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = ucfirst($this->faker->unique()->words(1, true)),
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
            'address' => $this->faker->streetAddress,
            'image_id' => Image::factory(),
        ];
    }
}
