<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('user', function(Blueprint $table) {
                  $table->boolean('is_admin')->default(false);
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('user', function(Blueprint $table) {
                  $table->dropColumn('is_admin');
            });
      }

}
