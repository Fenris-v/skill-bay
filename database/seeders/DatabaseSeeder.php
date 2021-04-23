<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                CategorySeeder::class,
                ProductSeeder::class,
                SellerSeeder::class,
                SpecificationSeeder::class,
                BannerSeeder::class,
                RoleSeeder::class,
                UserSeeder::class,
                RoleUsersSeeder::class,
                CartSeeder::class,
            ]
        );
    }
}
