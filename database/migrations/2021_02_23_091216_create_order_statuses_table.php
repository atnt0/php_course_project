<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('order_statuses') ) {
            Schema::create('order_statuses', function (Blueprint $table) {
                $table->id();

                $table->string('name', 32); // внутреннее имя

                $table->string('title', 64);
                $table->string('title_ua', 64);
                $table->string('title_ru', 64);

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
        Schema::dropIfExists('order_statuses');
    }
}
