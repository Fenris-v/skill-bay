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
        Seller::factory()
            ->count(30)
            ->create()
            ->each(
                fn($seller) => $seller->products()->attach(
                    array_combine(
                        Product::orderBy(\DB::raw('RAND()'))
                            ->take($amount = rand(2, 4))
                            ->select('id')
                            ->get()
                            ->pluck('id')
                            ->toArray(),
                        array_reduce(
                            range(0, $amount - 1, 1),
                            fn($accum, $item) => [...$accum, ['price' => rand(10000, 1000000) / 100]],
                            []
                        )
                    ),
                ),
            )
        ;
    }
}
