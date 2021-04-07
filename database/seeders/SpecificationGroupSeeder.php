<?php

namespace Database\Seeders;

use App\Models\SpecificationGroup;
use App\Models\Specification;
use App\Models\Product;
use Illuminate\Database\Seeder;

class SpecificationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        SpecificationGroup::factory()
            ->count(10)
            ->create()
            ->each(fn($group) => $group->specifications()->saveMany(
                Specification::factory()
                    ->count(rand(4, 8))
                    ->create()
                    ->each(fn($specification) => $specification
                        ->products()
                        ->attach($products->random(rand(1, 3)))
                    )
            ))
        ;
    }
}
