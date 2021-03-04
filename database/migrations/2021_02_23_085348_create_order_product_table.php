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

                $table->bigInteger('order_id')->unsigned();
                $table->bigInteger('product_id')->unsigned();

                $table->bigInteger('price')->unsigned()->default(0); // цена на момент заказа // умножение на 10 тысяч
                $table->bigInteger('tax')->unsigned()->default(0);
                $table->integer('quantity'); // заказанное количество

                //todo установить дату завершения заказа, на пример неделя

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('order_id')->references('id')->on('orders');

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
            $table->dropForeign(['product_id']);
            $table->dropForeign(['order_id']);
        });
        Schema::dropIfExists('order_product');
    }
}
