<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Advert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('title');
            $table->string('slug');
            $table->date('date');
            $table->string('content');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('filename');
            $table->integer('status');
            $table->integer('category');
            $table->integer('subcategory');
            $table->string('region');
            $table->string('number');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('site_uri');
            $table->integer('show');
            $table->integer('views');
            $table->timestamps();
        });

        Schema::create('type',function (Blueprint $table){
            $table->increments('id');
            $table->integer('advert_id');
            $table->integer('user_id');
            $table->string('type');
            $table->string('mass');
            $table->string('price');
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
        Schema::dropIfExists('type');
        Schema::dropIfExists('advert');
    }
}
