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
            ->count(30)
            ->create()
            ->each(
                fn($seller) => $seller->products()->attach(
                    $products
                        ->random(rand(4, 8))
                        ->mapWithKeys(fn($item) => [$item->id => ['price' => rand(10000, 1000000) / 100]])
                ),
            )
        ;
    }
}
