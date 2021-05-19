<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoriesTableToMakeHotCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_hot')
                ->default(false)
                ->after('icon')
                ->comment('Является ли категория горячей');

            $table->unsignedTinyInteger('hot_order')
                ->default(0)
                ->after('is_hot')
                ->comment('Положение по отношению других горячих категорий');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
