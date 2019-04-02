<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->text('shipping_address_id');
            $table->decimal('total_price');
            $table->timestamps('created_at');
        });
    }


    public function down()
    {
        Schema::drop('orders');
    }
}
