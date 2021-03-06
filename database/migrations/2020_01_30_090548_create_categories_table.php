<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('category_name');
            $table->integer('parent_category_id')->nullable();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::drop('categories');
    }
}
