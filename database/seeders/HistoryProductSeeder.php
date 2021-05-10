<?php

namespace Database\Seeders;

use App\Models\HistoryView;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class HistoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HistoryView::factory(100)->create();
    }
}
