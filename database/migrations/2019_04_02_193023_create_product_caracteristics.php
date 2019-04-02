<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCaracteristics extends Migration
{

    public function up()
    {
        Schema::create('product_caracteristics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('product_caracteristics');
    }
}
