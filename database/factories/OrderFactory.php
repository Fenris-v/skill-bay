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
        $user = User::first('id');

        return [
            'cart_id' => Cart::factory(),
            'user_id' => $this->faker->numberBetween(0, 1) ? $user->id : User::factory(),
            'delivery_type_id' => DeliveryType::inRandomOrder()->first(),
            'payment_type_id' => PaymentType::inRandomOrder()->first(),
            'city' => $this->faker->city,
            'address' => $this->faker->streetAddress,
            'price' => $this->faker->randomFloat(2, 1, 500),
            'discount' => $this->faker->numberBetween(0, 1)
                ? $this->faker->randomFloat(2, 1, 100)
                : null,
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now')
        ];
    }
}
