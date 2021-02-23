<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();

                $table->string('article_number');
                $table->integer('price');
                $table->integer('tax');
                $table->integer('quantity'); // ->nullable() // _in_stock // на складе
                $table->integer('status_id')->unsigned();
                $table->bigInteger('category_id')->unsigned();
                $table->bigInteger('user_own_id');
                $table->string('uuid');
                $table->string('title', 255);
                $table->string('title_ua', 255);
                $table->string('title_ru', 255);
                $table->string('description');
                $table->string('description_ua');
                $table->string('description_ru');

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
        Schema::dropIfExists('products');
    }
}
