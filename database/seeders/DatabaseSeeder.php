<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

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
                ProductSeeder::class,
                SellerSeeder::class,
                SpecificationSeeder::class,
                BannerSeeder::class,
                RoleSeeder::class,
                UserSeeder::class,
                RoleUsersSeeder::class,
                CategorySeeder::class,
            ]
        );
    }
}
