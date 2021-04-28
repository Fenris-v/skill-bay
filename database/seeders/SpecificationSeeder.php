<?php

namespace Database\Seeders;

use App\Models\Specification;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = Product::select('id')->get();
        Specification::factory()
            ->count(5)
            ->create()
            ->each(
                fn($specification) => $specification->products()
                    ->attach(
                        $products
                            ->random(rand(4, 8))
                            ->mapWithKeys(
                                fn($item) => [
                                    $item->id => [
                                        'value' => $specification->type === Specification::CHECKBOX
                                            ? $faker->numberBetween(0, 1)
                                            : $faker->word
                                    ]
                                ]
                            )
                    )
            );
    }
}
