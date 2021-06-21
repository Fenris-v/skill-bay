<?php

namespace Database\Seeders\DemoDataSeeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DvovladSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->create([
                "name" => "Vlad",
                'email' => "dvovlad@mail.ru",
                'password' => Hash::make('11111111'),
                'phone' => "79625110389"
            ]);
    }
}
