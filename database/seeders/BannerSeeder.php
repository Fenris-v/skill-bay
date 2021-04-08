<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = Image::create([
            'path' => 'drone.png',
        ]);

        Banner::create([
            'title' => 'Тестовый баннер 1',
            'description' => 'Описание первого тестового баннера',
            'url' => '/',
            'image_id' => $image->id,
        ]);

        Banner::create([
            'title' => 'Тестовый баннер 2',
            'description' => 'Описание второго тестового баннера',
            'url' => '/',
            'image_id' => $image->id,
        ]);
    }
}
