<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\DiscountUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiscountUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discount_id' => Discount::factory()
        ];
    }
}
