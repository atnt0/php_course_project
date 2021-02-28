<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();

                $table->integer('user_own_id')->unsigned()->nullable();

                $table->string('comment', 255); // customer_comment
                $table->string('email', 255); // customer_email
                $table->string('phone', 20); // customer_phone

                $table->string('address_city', 255);
                $table->string('address_zip', 255);
                $table->string('address_street', 255);
                $table->string('address_house', 255);
                $table->string('address_floor', 255);
                $table->string('address_apart', 255);

                $table->string('address_np_number', 255); // number of "Nova Poshta"

                $table->string('guest_ip', 40); // ipv4/ipv6
                $table->string('guest_useragent', 255);

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
        Schema::dropIfExists('orders');
    }
}
