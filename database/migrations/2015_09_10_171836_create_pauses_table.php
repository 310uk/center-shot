<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePausesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pauses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('play_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('play_id')->references('id')->on('plays');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pauses');
	}

}
