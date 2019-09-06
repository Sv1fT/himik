<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SendEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sendemails', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('number');
        $table->string('email');
        $table->string('massage');
        $table->string('ip');
        $table->string('url');
        $table->string('country');
        $table->string('region');
        $table->string('city');
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
        Schema::dropIfExists('country');
    }
}
