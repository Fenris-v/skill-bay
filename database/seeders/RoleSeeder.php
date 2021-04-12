<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'slug' => 'admin',
                'name' => 'Администратор',
                'permissions' => [
                    'platform.index' => true,
                    'platform.systems.index' => true,
                    'platform.systems.roles' => true,
                    'platform.systems.users' => true,
                    'platform.systems.attachment' => true,
                ],
            ],
            [
                'slug' => 'buyer',
                'name' => 'Покупатель',
                'permissions' => [
                    'platform.index' => false,
                    'platform.systems.index' => false,
                    'platform.systems.roles' => false,
                    'platform.systems.users' => false,
                    'platform.systems.attachment' => false,
                ],
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
