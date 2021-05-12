<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountUnitablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_unitables', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id');
            $table->morphs('unitable');

            $table->primary(['unit_id', 'unitable_id', 'unitable_type']);
            $table->foreign('unit_id')
                ->references('id')
                ->on('discount_units')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_unitables');
    }
}
