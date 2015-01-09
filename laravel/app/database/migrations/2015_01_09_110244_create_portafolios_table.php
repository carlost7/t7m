<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePortafoliosTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('portafolios', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('proyecto');
                  $table->string('imagen');
                  $table->string('thumb');
                  $table->string('url')->nullable();
                  $table->string('descripcion')->nullable();
                  $table->string('categoria');
                  $table->string('thumb_name');
                  $table->string('full_name');
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
            Schema::drop('portafolios');
      }

}
