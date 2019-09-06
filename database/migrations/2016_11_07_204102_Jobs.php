<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('city');
            $table->string('category');
            $table->string('name');
            $table->string('slug');
            $table->string('price');
            $table->string('price1');
            $table->string('valute');
            $table->string('status');
            $table->text('opit');
            $table->text('education');
            $table->text('description');
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
        Schema::dropIfExists('vacant');
    }
}
