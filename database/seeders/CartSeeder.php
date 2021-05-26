<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Visitor;
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
        Cart::factory()
            ->count(5)
            ->create()
            ->each(
                function ($cart) use ($products) {
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
