<?php

namespace Database\Seeders;

use App\Models\DiscountUnit;
use Illuminate\Database\Seeder;

class DiscountUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscountUnit::factory()
            ->count(5)
            ->create();
    }
}
