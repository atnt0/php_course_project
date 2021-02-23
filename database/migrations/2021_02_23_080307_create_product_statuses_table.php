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
                $table->string('name');
                $table->string('title');
                $table->string('title_ua');
                $table->string('title_ru');
                $table->timestamp = false;
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
