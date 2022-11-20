<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id_customer');
            $table->text('image_customer');
            $table->string('name_customer');
            $table->integer('age_customer');
            $table->string('sex_customer');
            $table->string('email_customer');
            $table->string('phone_customer');
            $table->string('address_customer');
            $table->string('password_customer');
            $table->integer('vip_customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
