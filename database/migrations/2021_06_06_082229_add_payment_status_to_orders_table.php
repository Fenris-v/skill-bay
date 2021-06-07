<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStatusToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('payment_status')
                ->default(\App\Models\Order::PAYMENT_STATUS_NOT_PAYED)
                ->comment('Оплачен ли заказ.');

            $table->string('payment_error_message')
                ->nullable()
                ->comment('Ошибка оплаты.');
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
            $table->dropColumn('payment_status');
            $table->dropColumn('payment_error_message');
        });
    }
}
