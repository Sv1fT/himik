<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('name');
            $table->string('allpass');
            $table->string('city');
            $table->string('region');
            $table->string('country');
            $table->string('status');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('users_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('filename');
            $table->integer('user_id')->UNSIGNED()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('company');
            $table->string('region');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('number');
            $table->string('description');
            $table->string('site');
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
        Schema::dropIfExists('users_attributes');
        Schema::dropIfExists('users');
    }
}
