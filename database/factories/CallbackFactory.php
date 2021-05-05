<?php

namespace Database\Factories;

use App\Models\Callback;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Callback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'message' => $this->faker->sentence(50),
            'created_at' => $this->faker->dateTimeBetween('-30 days')
        ];
    }
}
