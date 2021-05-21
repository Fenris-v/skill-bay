<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [Discount::PRODUCT, Discount::GROUP, Discount::CART];

        return [
            'title' => $title = ucfirst($this->faker->unique()->words(3, true)),
            'slug' => Str::slug($title),
            'value' => $discount = $this->faker->numberBetween(1, 200),
            'description' => $this->faker->sentence,
            'begin_at' => $this->faker->numberBetween(0, 1)
                ? $this->faker->dateTimeBetween('-30 days', '+29 days') : null,
            'end_at' => $this->faker->numberBetween(0, 1)
                ? $this->faker->dateTimeBetween('+30 days', '+60 days') : null,
            'type' => $this->faker->randomElement($types),
            'unit_type' => $discount > 99 ? Discount::UNIT_CURRENCY : Discount::UNIT_PERCENT,
            'priority' => $this->faker->numberBetween(10, 999),
            'image_id' => Attachment::factory(),
        ];
    }
}
