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
        if ( !Schema::hasTable('products') ) {
            Schema::create('products', function (Blueprint $table) {
//                $table->id();

                $table->string('uuid', 36)->unique()->nullable(false)->default('');

                $table->string('article_number');

                $table->bigInteger('price')->unsigned()->default(0); // умножение на 10 тысяч
//                $table->bigInteger('tax')->unsigned()->default(0);
                $table->bigInteger('quantity')->unsigned()->default(0); // ->nullable() // _in_stock // количество на складе

                $table->unsignedBigInteger('category_id');

                $table->bigInteger('user_own_id')->unsigned();

                $table->string('slug', 255)->nullable(false);

                $table->string('title', 255)->default('');
                $table->string('title_ua', 255)->default('');
                $table->string('title_ru', 255)->default('');
                $table->longText('description')->default('');
                $table->longText('description_ua')->default('');
                $table->longText('description_ru')->default('');

                $table->string('meta_keywords', 255)->default('');
                $table->string('meta_description', 255)->default('');

                $table->foreign('category_id')->references('id')->on('product_categories');
                    //->onDelete('cascade');


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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('products');
    }
}
