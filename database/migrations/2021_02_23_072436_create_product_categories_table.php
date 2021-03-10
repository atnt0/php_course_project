<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_categories')) {
            Schema::create('product_categories', function (Blueprint $table) {
                $table->id();

                $table->bigInteger('parent_id')->unsigned()->nullable(); // parent category id

                $table->string('slug', 255)->nullable(false)->default('');

                $table->string('title', 255)->nullable()->default('');
                $table->string('title_ua', 255)->nullable()->default('');
                $table->string('title_ru', 255)->nullable()->default('');
                $table->string('description')->nullable()->default('');
                $table->string('description_ua')->nullable()->default('');
                $table->string('description_ru')->nullable()->default('');

                $table->foreign('parent_id')->references('id')->on('product_categories');

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
        Schema::dropIfExists('product_categories');
    }
}
