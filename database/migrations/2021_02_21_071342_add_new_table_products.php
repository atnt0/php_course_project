<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // тут стоит добавить условие "нет ли"
        if ( !Schema::hasTable('products') ) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->string('articul_code');
                $table->string('title');

                //$table->timestamp('failed_at')->useCurrent(); // original
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
        Schema::dropIfExists('products');
    }
}
