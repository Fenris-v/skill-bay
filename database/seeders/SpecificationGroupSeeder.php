<?php

namespace Database\Seeders;

use App\Models\SpecificationGroup;
use App\Models\Specification;
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
        SpecificationGroup::factory()
            ->count(10)
            ->create()
            ->each(fn($group) => $group->specifications()->saveMany(
                Specification::factory()
                    ->count(rand(1, 3))
                    ->create()
            ))
        ;
    }
}
