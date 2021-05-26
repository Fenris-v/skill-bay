<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCartsTableIssue72 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
            $table->dropColumn(['guest_id']);
            $table->unsignedBigInteger('visitor_id');
            $table->foreign('visitor_id')
                ->references('id')
                ->on('visitors')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['visitor_id']);
            $table->dropColumn(['visitor_id']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->uuid('guest_id')->nullable()->unique();
        });
    }
}
