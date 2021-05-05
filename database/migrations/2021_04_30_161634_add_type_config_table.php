<?php

use App\Models\Admin\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'configs',
            function (Blueprint $table) {
                $table->unsignedSmallInteger('content_type')
                    ->default(Config::CONFIG);
            }
        );

        $configs = [
            [
                'slug' => 'phone',
                'type_id' => Config::STRING_TYPE,
                'value' => '8-800-200-600',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'country',
                'type_id' => Config::STRING_TYPE,
                'value' => 'Россия',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'region',
                'type_id' => Config::STRING_TYPE,
                'value' => 'Свердловская область',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'city',
                'type_id' => Config::STRING_TYPE,
                'value' => 'Каменск-Уральский',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'address',
                'type_id' => Config::STRING_TYPE,
                'value' => 'Заводской проезд, 1',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'email',
                'type_id' => Config::STRING_TYPE,
                'value' => 'megano@skillbox_diploma.com',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'facebook',
                'type_id' => Config::STRING_TYPE,
                'value' => 'https://www.facebook.com/',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'twitter',
                'type_id' => Config::STRING_TYPE,
                'value' => 'https://twitter.com/',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'linkedin',
                'type_id' => Config::STRING_TYPE,
                'value' => 'https://www.linkedin.com/',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'about_us',
                'type_id' => Config::WYSIWYG_TYPE,
                'value' => '<h2>Товарный агругатор Megano</h2><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem.</p><p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justotuio, rhoncus ut loret, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus element semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae ligula eget dolor. Aenean massa. Cumtipsu sociis natoque pena tibusetm t semper ni.</p>',
                'content_type' => Config::INFO
            ],
            [
                'slug' => 'store_history',
                'type_id' => Config::WYSIWYG_TYPE,
                'value' => '<h2>Megano Store Hystory</h2><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit doli. Aenean commodo ligula eget dolor. Aenean massa. Cumtipsu sociis natoque penatibus et magnis dis parturient montesti, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eutu, pretiumem.</p><ul><li>Lorem ipsum dolor sit amet, consectetuer</li><li>adipiscing elit doli. Aenean commodo ligula</li><li>eget dolor. Aenean massa. Cumtipsu sociis</li><li>natoque penatibus et magnis dis parturient</li><li>montesti, nascetur ridiculus mus. Donec</li><li>quam felis, ultricies nec, pellentesque eutu</li></ul>',
                'content_type' => Config::INFO
            ],
        ];

        foreach ($configs as $config) {
            Config::create($config);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['content_type']);
        });
    }
}
