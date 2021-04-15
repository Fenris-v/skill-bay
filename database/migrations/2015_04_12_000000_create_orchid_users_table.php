<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchidUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->jsonb('permissions')->nullable();
            }
        );

//        User::create(
//            [
//                'name' => 'admin',
//                'email' => 'admin@admin.com',
//                'password' => password_hash('secret', PASSWORD_DEFAULT),
//                'permissions' => [
//                    'platform.index' => true,
//                    'platform.systems.index' => true,
//                    'platform.systems.roles' => true,
//                    'platform.systems.users' => true,
//                    'platform.systems.attachment' => true,
//                ]
//            ]
//        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->dropColumn(['permissions']);
            }
        );
    }
}
