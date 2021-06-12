<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountUnit;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createUnitsFn = function(int $amount, Discount $discount) {
            $randFn = fn(Model $model) => $model::orderBy(DB::raw('RAND()'))->select('id')->take(rand(1, 3))->get();
            return DiscountUnit::factory(['discount_id' => $discount->id])
                ->count($amount)
                ->create()
                ->each(function($unit) use ($randFn) {
                    $unit->products()->attach($randFn(new Product));
                    $unit->categories()->attach($randFn(new Category));
                })
            ;
        };

        Discount::factory()
            ->count(10)
            ->create()
            ->each(
                function($discount) use ($createUnitsFn) {
                    match($discount->type) {
                        Discount::PRODUCT => $discount->discountUnit()->saveMany($createUnitsFn(1, $discount)),
                        Discount::GROUP => $discount->discountUnit()->saveMany($createUnitsFn(rand(2, 4), $discount)),
                        Discount::CART => null,
                    };
                    $discount->save();
                }
            )
        ;
    }
}
