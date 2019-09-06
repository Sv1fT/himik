<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->integer('status');
            $table->text('token');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('users_attributes', function(Blueprint $table){
            $table->integer('user_id');
            $table->string('company');
            $table->string('name');
            $table->string('filename');
            $table->integer('region');
            $table->string('number');
            $table->string('city');
            $table->string('address');
            $table->text('description');
            $table->text('site');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('users_attributes');
    }
}
