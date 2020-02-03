<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{

    public function up()
    {
        Schema::create('shops', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('adress')->nullable();
            $table->string('contact')->nullable();
            $table->string('opening_hour')->nullable();
            $table->string('closure_hour')->nullable();
            $table->string('tax_identification')->nullable();
            $table->unsignedInteger('shop_owner_id')->nullable();
            $table->foreign('shop_owner_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::drop('shops');
    }
}
