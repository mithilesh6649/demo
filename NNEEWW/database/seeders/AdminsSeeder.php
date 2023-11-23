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
		
		// Admins
		
		\DB::table('admins')->delete();
		\DB::table('admins')->insert([
			[
				'role_id' => 1,
				'full_name' => 'Super Admin',
				'email' => 'superadmin@genahealthx.com',
				'email_verified_at' => now(),
				'password' => Hash::make('Sup3r@dm!n'),
			]
		]);
	}
}