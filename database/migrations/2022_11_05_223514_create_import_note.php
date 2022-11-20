<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_note', function (Blueprint $table) {
            $table->increments('id_import');
            $table->integer('id_color');
            $table->string('code_note');
            $table->string('name_product');;
            $table->integer('quantity_product');
            $table->integer('price_product');
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
        Schema::dropIfExists('import_note');
    }
}
