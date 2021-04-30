<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DiscountUnit;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountUnitableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = DiscountUnit::get('id');
        $relations = [Product::class, Category::class];
        $products = Product::get('id')->pluck('id')->toArray();
        $categories = Category::get('id')->pluck('id')->toArray();

        foreach ($units as $unit) {
            $productsTmp = $products;
            $categoriesTmp = $categories;
            for ($i = 0; $i < 3; $i++) {
                shuffle($productsTmp);
                shuffle($categoriesTmp);
                shuffle($relations);
                $relation = $relations[0];

                DB::table('discount_unitables')
                    ->insert(
                        [
                            'unit_id' => $unit->id,
                            'unitable_type' => $relation,
                            'unitable_id' => $relation === Product::class
                                ? array_shift($productsTmp)
                                : array_shift($categoriesTmp)
                        ]
                    );
            }
        }
    }
}
