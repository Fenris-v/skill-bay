<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->count(7)
            ->has(Category::factory()
                ->count(3)
                ->has(Category::factory()
                    ->count(2)
                    ->has(Category::factory()
                        ->count(2), 'children'), 'children'), 'children')
            ->create();

    }
}
