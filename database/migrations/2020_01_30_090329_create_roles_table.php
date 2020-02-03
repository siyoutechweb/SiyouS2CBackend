<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{

    public function up()
    {
        Schema::create('Roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::drop('Roles');
    }
}