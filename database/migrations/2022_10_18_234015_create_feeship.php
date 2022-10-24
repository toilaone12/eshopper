<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeship', function (Blueprint $table) {
            $table->increments('id_feeship');
            $table->integer('province_feeship');
            $table->integer('district_feeship');
            $table->integer('commune_feeship');
            $table->string('price_feeship');
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
        Schema::dropIfExists('feeship');
    }
}
