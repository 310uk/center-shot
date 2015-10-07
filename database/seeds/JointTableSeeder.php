<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class JointTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('joints')->truncate();

		DB::table('joints')->insert([
			['type' => '3/8-10'],
			['type' => '3/8-11'],
			['type' => '5/16-14'],
			['type' => '5/16-18'],
			['type' => 'Radial'],
			['type' => 'Uni-Loc'],
			['type' => 'Wavy'],
			['type' => 'United'],
		]);
	}

}
