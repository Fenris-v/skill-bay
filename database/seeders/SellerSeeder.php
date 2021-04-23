<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::select('id')->get();
        Seller::factory()
            ->count($products->count())
            ->create()
            ->each(
                fn($seller, $key) => $seller->products()->attach(
                    (!$key ? $products : $products->filter(fn($item) => !$item->sellers->count()))
                        ->random(rand(4, 8))
                        ->mapWithKeys(fn($item) => [$item->id => ['price' => rand(10000, 1000000) / 100]])
                ),
            )
        ;
    }
}
