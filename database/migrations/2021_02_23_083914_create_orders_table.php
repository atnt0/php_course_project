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

                $table->bigInteger('user_own_id')->unsigned()->nullable();

                $table->string('uuid', 36)->unique()->nullable(false);
//                $table->string('slug', 255)->nullable(false);

                $table->string('comment', 255)->nullable()->default(''); // customer_comment
                $table->string('email', 255)->nullable()->default(''); // customer_email
                $table->string('phone', 20)->nullable()->default(''); // customer_phone

                $table->string('address_city', 255)->nullable()->default('');
                $table->string('address_zip', 255)->nullable()->default('');
                $table->string('address_street', 255)->nullable()->default('');
                $table->string('address_house', 255)->nullable()->default('');
                $table->string('address_floor', 255)->nullable()->default('');
                $table->string('address_apart', 255)->nullable()->default('');

                $table->string('address_np_number', 255)->nullable()->default(''); // number of "Nova Poshta"

                $table->string('guest_ip', 40); // ipv4/ipv6
                $table->string('guest_useragent', 255);

                $table->string('client_first_name', 100)->nullable()->default('');
                $table->string('client_last_name', 100)->nullable()->default('');
                $table->string('client_patronymic_name', 100)->nullable()->default('');

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
