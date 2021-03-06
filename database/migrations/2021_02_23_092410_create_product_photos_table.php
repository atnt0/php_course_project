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
            $table->string('uuid', 36)->unique()->nullable(false)->default('');

            $table->string('product_uuid', 36);

            $table->TinyInteger('index')->unsigned();; // порядковый номер, 0 - первое, отображается как главное изображение

            $table->string('file_name');

            $table->bigInteger('user_own_id')->unsigned();

            $table->string('description', 255)->default('');
            $table->string('description_ua', 255)->default('');
            $table->string('description_ru', 255)->default('');

            $table->foreign('product_uuid')->references('uuid')->on('products');

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
            $table->dropForeign(['product_uuid']);
        });
        Schema::dropIfExists('product_photos');
    }
}
