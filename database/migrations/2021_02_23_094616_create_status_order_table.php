<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('status_order')) {
            Schema::create('status_order', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('order_id')->unsigned();
                $table->bigInteger('status_id')->unsigned();

                $table->foreign('order_id')->references('id')->on('orders');
                $table->foreign('status_id')->references('id')->on('order_statuses');

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
        //TODO может стоит добавить проверку на существования базы?
        Schema::table('status_order', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('status_order');
    }
}
