<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRezumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rezumes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio');
            $table->string('email');
            $table->string('number');
            $table->string('age');
            $table->string('city');
            $table->string('region');
            $table->string('filename');
            $table->string('pereezd');
            $table->string('category')->null();
            $table->string('dolzhnost');
            $table->string('price');
            $table->string('slug');
            $table->text('status');
            $table->text('opit');
            $table->text('education');
            $table->text('language');
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
        Schema::dropIfExists('rezumes');
    }
}
