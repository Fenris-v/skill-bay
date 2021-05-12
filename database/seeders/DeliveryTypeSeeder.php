<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryType::create([
           'name' => 'Обычная доставка',
        ]);

        DeliveryType::create([
           'name' => 'Экспресс доставка',
           'price' => '500.00',
        ]);
    }
}
