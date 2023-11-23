<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		Schema::disableForeignKeyConstraints();
		\DB::table('roles')->truncate();
		\DB::table('roles')->insert([
			[
				'name' => 'Super Admin',
				'tag' => 'super_admin'
			],
			[
				'name' => 'User',
				'tag' => 'user'
			],
			[
				'name' => 'Nutritionist',
				'tag' => 'nutritionist'
			],
			[
				'name' => 'Clinicians',
				'tag' => 'clinicians'
			]
			
		]);
	}
}
