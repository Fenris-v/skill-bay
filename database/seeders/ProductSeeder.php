<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;

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
            ->has(ProductReview::factory()->count(5), 'reviews')
            ->create()
            ->each(fn($product) => $product->images()->attach(
                Image::factory()
                    ->count(2)
                    ->create()
            ))
        ;
    }
}
