<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class AdminsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		
		\DB::table('admins')->truncate();
		\DB::table('admins')->insert([
			[
				'first_name' => 'Super',
				'last_name' => 'Admin',
				'email' => 'superadmin@mission22.com',
				'password' => Hash::make('Sup3r@dm!n'),
				'role_id' => 1
			], 
		]);
		
	}
}