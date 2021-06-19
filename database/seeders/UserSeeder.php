<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(30)
            ->create();
        User::factory()
            ->create([
                "name" => "Vlad",
                'email' => "dvovlad@mail.ru",
                'password' => Hash::make('11111111'),
                'phone' => "79625110389"
            ]);
    }
}
