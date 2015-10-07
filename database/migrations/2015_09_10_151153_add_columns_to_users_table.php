<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->timestamp('begun_from')->nullable();
			$table->integer('def_li')->default(100);
			$table->integer('def_cn')->default(50);
			$table->integer('def_cs')->default(10);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
            $table->dropColumn('begun_from');
            $table->dropColumn('def_li');
            $table->dropColumn('def_cn');
            $table->dropColumn('def_cs');
		});
	}

}
