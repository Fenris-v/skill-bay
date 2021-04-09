<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin\Config;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'configs',
            function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->unsignedSmallInteger('type_id');
                $table->text('value');
            }
        );

        $fields = [
            [
                'slug' => Str::slug('Количество товаров на странице'), /* При добавлении реальной опции,
                    дать осмысленное название, например, per_page.
                    Str::slug используется только для примера */
                'type_id' => Config::INT_TYPE,
                'value' => 20,
            ],
            [
                'slug' => Str::slug('Строка например'),
                'type_id' => Config::STRING_TYPE,
                'value' => 'Какой-то рандомный текст',
            ],
            [
                'slug' => Str::slug('А вот и чекбокс'),
                'type_id' => Config::CHECKBOX_TYPE,
                'value' => true,
            ],
        ];

        foreach ($fields as $field) {
            Config::create($field);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
