<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAdress extends Migration
{

    public function up()
    {
        Schema::create('shipping_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('cep');
            $table->timestamps('created_at');
        });
    }


    public function down()
    {
        Schema::drop('shipping_address');
    }
}
