<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('id_category');
            $table->integer('id_brand');
            $table->string('name_product');
            $table->text('image_product');
            $table->integer('quantity_sold_product');
            $table->integer('price_product');
            $table->integer('number_reviews');
            $table->integer('number_views');
            $table->text('description_product');
            $table->text('content_product');
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
        Schema::dropIfExists('product');
    }
}
