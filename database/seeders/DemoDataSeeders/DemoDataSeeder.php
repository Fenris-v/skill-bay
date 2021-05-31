<?php

namespace Database\Seeders\DemoDataSeeders;

use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * command to run it:
     * sail artisan db:seed \\Database\\Seeders\\DemoDataSeeders\\DemoDataSeeder
     */
    public function run()
    {
        $this->call(
            [
                DvovladSeeder::class,
                FenrisVSeeder::class,
                MikhailPeretyatkoSeeder::class,
                Olegsv3007Seeder::class,
                RSarvarovSeeder::class,
            ]
        );
    }
}
