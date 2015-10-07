<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MakerTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('makers')->truncate();

		DB::table('makers')->insert([
			['name' => 'ADAM'],
			['name' => 'Musashi'],
			['name' => 'Mezz'],
			['name' => 'Exceed'],
			['name' => 'Predetor'],
			['name' => 'OB'],
		]);
	}

}
