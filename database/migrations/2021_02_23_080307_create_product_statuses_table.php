<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('product_statuses')) {
            Schema::create('product_statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // внутреннее имя

                $table->string('title', 32);
                $table->string('title_ua', 32);
                $table->string('title_ru', 32);

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
        Schema::dropIfExists('product_statuses');
    }
}
