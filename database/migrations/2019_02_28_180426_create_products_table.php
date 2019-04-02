<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('stock');
            $table->decimal('anchor_price');
            $table->decimal('final_price');
            $table->text('image');
            $table->string('color_id');
        });
    }


    public function down()
    {
        Schema::drop('products');
    }
}
