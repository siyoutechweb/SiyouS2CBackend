<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->float('member_price');
            $table->integer('chaine_id');
            $table->integer('cachier_id');
            $table->foreign('chaine_id')->references('id')->on('chaines');
            $table->foreign('cachier_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}
