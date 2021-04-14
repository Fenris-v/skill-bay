<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all(['id', 'slug']);
        $buyerId = $roles->where('slug', 'buyer')->first()->id;
        $adminId = $roles->where('slug', 'admin')->first()->id;

        foreach (User::all(['id', 'name']) as $user) {
            $user->roles()
                ->attach($user->name === 'admin' ? $adminId : $buyerId);
        }
    }
}
