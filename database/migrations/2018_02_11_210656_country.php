<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Country extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('country', function (Blueprint $table) {
         $table->increments('id');
         $table->string('name');
         $table->string('slug');
         $table->string('type');
         $table->string('crt_date');
         $table->string('updated_at');
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