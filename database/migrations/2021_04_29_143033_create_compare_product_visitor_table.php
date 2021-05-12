<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompareProductVisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compare_product_visitor', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_id');
            $table->unsignedBigInteger('product_id');
            $table->primary(['visitor_id', 'product_id']);
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compare_product_visitor');
    }
}
