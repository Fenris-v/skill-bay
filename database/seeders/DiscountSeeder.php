<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\DiscountUnit;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::factory()
            ->count(10)
            ->has(DiscountUnit::factory()->count(3))
            ->create();
    }
}
