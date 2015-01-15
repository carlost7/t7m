<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPrioridadToPortafolios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portafolios', function(Blueprint $table)
		{
			$table->integer('prioridad')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('portafolios', function(Blueprint $table)
		{
			$table->dropColumn('prioridad');
		});
	}

}
