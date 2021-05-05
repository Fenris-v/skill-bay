<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cart_id' => Cart::factory(),
            'user_id' => User::factory(),
            'delivery_type_id' => DeliveryType::inRandomOrder()->first(),
            'payment_type_id' => PaymentType::inRandomOrder()->first(),
            'city' => $this->faker->city,
            'address' => $this->faker->streetAddress,
        ];
    }
}
