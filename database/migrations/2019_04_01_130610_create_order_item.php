<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItem extends Migration
{

    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('sku');
            $table->string('quantity');
            $table->string('price');
        });
    }


    public function down()
    {
        Schema::drop('order_items');
    }
}
