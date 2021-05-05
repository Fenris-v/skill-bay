<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Attachment;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(50)
            ->create()
            ->each(fn($product) => $product->images()->attach(
                Attachment::factory()
                    ->count(2)
                    ->create()
            ))
        ;
    }
}
