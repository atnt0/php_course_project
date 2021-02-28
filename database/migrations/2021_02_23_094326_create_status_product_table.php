<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('status_product')) {
            Schema::create('status_product', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('product_id')->unsigned();
                $table->bigInteger('status_id')->unsigned();

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('status_id')->references('id')->on('product_statuses');

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
        Schema::table('status_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('status_product');
    }
}
