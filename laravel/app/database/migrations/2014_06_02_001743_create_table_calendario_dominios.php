<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCalendarioDominios extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('calendario_dominios', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('dominio');
                  $table->date('inicio');
                  $table->date('fin');
                  $table->string('registrador');
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
            Schema::dropTable('calendario_dominios');
      }

}
