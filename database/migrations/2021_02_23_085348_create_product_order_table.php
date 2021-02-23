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

                $table->integer('order_id')->unsigned();
                $table->integer('product_id')->unsigned();
                $table->integer('quantity'); // заказанное количество

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
        Schema::dropIfExists('product_order');
    }
}