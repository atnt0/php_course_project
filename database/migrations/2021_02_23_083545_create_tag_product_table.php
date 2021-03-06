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

                $table->string('product_uuid', 36);
                $table->bigInteger('tag_id')->unsigned();

                $table->foreign('product_uuid')->references('uuid')->on('products');
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
            $table->dropForeign(['product_uuid']);
            $table->dropForeign(['tag_id']);
        });
        Schema::dropIfExists('tag_product');
    }
}
