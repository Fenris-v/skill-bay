<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Admin\Config;

class UpdateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Config::create(
            [
                'slug' => 'history_size',
                'type_id' => Config::INT_TYPE,
                'value' => 20,
            ]
        );
    }
}
