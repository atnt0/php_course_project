<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tag_product')) {
            Schema::create('tag_product', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('product_id')->unsigned();
                $table->bigInteger('tag_id')->unsigned();

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('tag_id')->references('id')->on('product_tags');

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
        Schema::table('tag_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['tag_id']);
        });
        Schema::dropIfExists('tag_product');
    }
}
