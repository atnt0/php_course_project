<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_order')) {
            Schema::create('product_order', function (Blueprint $table) {
                $table->id();

                $table->bigInteger('order_id')->unsigned();
                $table->bigInteger('product_id')->unsigned();

                $table->integer('quantity'); // заказанное количество

                $table->foreign('order_id')->references('id')->on('orders');
                $table->foreign('product_id')->references('id')->on('products');

                $table->timestamp = false;
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
        Schema::table('product_order', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('product_order');
    }
}
