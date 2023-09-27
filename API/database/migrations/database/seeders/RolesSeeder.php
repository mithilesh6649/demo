<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		\DB::table('roles')->truncate();
		\DB::table('roles')->insert([
			[
				'name' => 'Super Admin',
				'tag' => 'super_admin',
				'role_type' => 'super_admin'
			],
			[
				'name' => 'Admin',
				'tag' => 'admin',
				'role_type' => 'admin'
			],
			[
				'name' => 'Customer',
				'tag' => 'customer',
				'role_type' => 'customer'
			],
			[
				'name' => 'Manager',
				'tag' => 'manager',
				'role_type' => 'manager'
			],
		]);
	}
}
