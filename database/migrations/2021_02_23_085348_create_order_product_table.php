<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order_product')) {
            Schema::create('order_product', function (Blueprint $table) {
                $table->id();

                $table->string('order_uuid', 36);
                $table->string('product_uuid', 36);

                $table->bigInteger('price')->unsigned()->default(0); // цена на момент заказа // умножение на 10 тысяч
//                $table->bigInteger('tax')->unsigned()->default(0);
                $table->integer('quantity')->unsigned()->default(0); // заказанное количество

                //todo установить дату завершения заказа, на пример неделя

                $table->foreign('order_uuid')->references('uuid')->on('orders');
                $table->foreign('product_uuid')->references('uuid')->on('products');

                //$table->timestamp = false;
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropForeign(['order_uuid']);
            $table->dropForeign(['product_uuid']);
        });
        Schema::dropIfExists('order_product');
    }
}
