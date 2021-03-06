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

                $table->string('product_uuid', 36);
                $table->bigInteger('status_id')->unsigned();

                $table->foreign('product_uuid')->references('uuid')->on('products');
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
            $table->dropForeign(['product_uuid']);
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('status_product');
    }
}
