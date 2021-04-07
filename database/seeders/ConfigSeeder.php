<?php

namespace Database\Seeders;

use App\Models\Admin\Config;
use Illuminate\Database\Seeder;
use Str;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            [
                'slug' => Str::slug('Количество товаров на странице'),
                'type_id' => 1,
                'value' => 20,
            ],
            [
                'slug' => Str::slug('Строка например'),
                'type_id' => 2,
                'value' => 'Какой-то рандомный текст',
            ],
            [
                'slug' => Str::slug('А вот и чекбокс'),
                'type_id' => 3,
                'value' => true,
            ],
        ];

        foreach ($fields as $field) {
            Config::create($field);
        }
    }
}
