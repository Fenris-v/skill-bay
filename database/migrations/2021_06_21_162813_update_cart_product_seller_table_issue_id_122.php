<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCartProductSellerTableIssueId122 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_product_seller', function (Blueprint $table) {
            $table->float('used_price')
                ->nullable()
            ;
            $table->float('used_discount')
                ->nullable()
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
        Schema::table('cart_product_seller', function (Blueprint $table) {
            $table->dropColumn(['used_discount', 'used_price']);
        });
    }
}
