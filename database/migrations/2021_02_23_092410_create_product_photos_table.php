<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();

            $table->integer('index')->unsigned(); // порядковый номер, 0 - первое, отображается как главное изображение

            $table->string('file_name');

            $table->bigInteger('user_own_id')->unsigned();

            $table->string('description', 255);
            $table->string('description_ua', 255);
            $table->string('description_ru', 255);

            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_photos', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('product_photos');
    }
}