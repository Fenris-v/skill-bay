<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()
            ->count(5)
            ->has(Category::factory()->count(2), 'children')
            ->create();

        $hotCategories = $categories->random(3);

        $hotCatI = 0;
        foreach ($hotCategories as $hotCategory) {
            $hotCategory->is_hot = true;
            $hotCategory->hot_order = $hotCatI++;
            $hotCategory->save();
        }
    }
}
