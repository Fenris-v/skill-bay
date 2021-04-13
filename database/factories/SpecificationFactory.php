<?php

namespace Database\Factories;

use App\Models\Specification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SpecificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Specification::class;

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
        ];
    }
}
