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

                $table->integer('price')->unsigned(); //TODO не забыть про умножение на 10 тысяч!!!
                $table->integer('tax')->unsigned(); // та же история про 10 тысяч!
                $table->integer('quantity')->unsigned(); // ->nullable() // _in_stock // иличество на складе

                $table->bigInteger('category_id')->unsigned();
                $table->bigInteger('user_own_id')->unsigned();

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
