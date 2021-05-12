<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::select('id')->get();
        $users = User::select('id')->get();
        Cart::factory()
            ->count(5)
            ->create()
            ->each(
                function ($cart) use ($users, $products) {
                    $cart->user()->associate($users->random());
                    $cart->save();
                    $cart->products()->attach(
                        $products
                            ->random(rand(1, $products->count()))
                            ->mapWithKeys(fn($item) => [
                                $item->id => [
                                    'seller_id' => $item->sellers->random()->id,
                                    'amount' => rand(1, 10)
                                ]
                            ])
                    );
                }
            )
        ;
    }
}
