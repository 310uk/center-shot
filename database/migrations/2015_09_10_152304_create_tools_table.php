<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tools', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('type');			//Play/Break/Jump etc.
			$table->string('maker_butt')->nullable();	//Maker name of Butt
			$table->string('name_butt')->nullable();	//Name of Butt
			$table->string('maker_shaft')->nullable();	//Maker name of Shaft
			$table->string('name_shaft')->nullable();	//Name of Shaft
			$table->string('joint')->nullable();		//joint type
			$table->string('maker_tip')->nullable();	//Maker name of tip
			$table->string('name_tip')->nullable();		//Name of tip
			$table->text('other')->nullable();			//memo
			$table->boolean('loose')->default(false);	//past have
			$table->timestamp('bought_at')->nullable();//bought
			$table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users');
			// $table->foreign('maker_bat')->references('name')->on('makers');
			// $table->foreign('maker_shaft')->references('name')->on('makers');
			// $table->foreign('maker_tip')->references('name')->on('makers');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tools');
	}

}
