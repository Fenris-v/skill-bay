<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedFloat('price')->nullable();;
            $table->unsignedFloat('discount')->nullable();
            $table->foreignId('cart_id')->nullable()->change();
            $table->foreignId('delivery_type_id')->nullable()->change();
            $table->foreignId('payment_type_id')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['price', 'discount', 'phone', 'name', 'email']);
            $table->foreignId('cart_id')->nullable(false)->change();
            $table->foreignId('delivery_type_id')->nullable(false)->change();
            $table->foreignId('payment_type_id')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
        });
    }
}
