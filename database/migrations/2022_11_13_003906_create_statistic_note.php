<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_note', function (Blueprint $table) {
            $table->increments('id_statistic_note');
            $table->integer('type_statistic_note');
            $table->integer('quantity_statistic_note');
            $table->integer('price_statistic_note');
            $table->date('date_statistic_note');
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
        Schema::dropIfExists('statistic_note');
    }
}
