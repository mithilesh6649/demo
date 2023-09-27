<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PettyExpenseCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('daily_petty_expense_categories')->truncate();
		\DB::table('daily_petty_expense_categories')->insert([
			[
				'cat_name' => 'Gas Cylinder Refilling',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
			[
				'cat_name' => 'Purchase-Co-Operative',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
			[
				'cat_name' => 'Vehicle',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Repair & Maint.(Restaurant)',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],

            [
				'cat_name' => 'Staff Accomodation(Allowance)',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Giveaway(Haras)',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Telephone/Mobile',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Staff Medical',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Legal Fees Others',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Office Stationery',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Electricity Bill',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Wages-Staff Exp.(Casual)',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Taxi & Parking',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
            [
				'cat_name' => 'Exp.',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],

            [
                'cat_name' => 'PV-Voucher',
                'status' => 0,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],
		]);
    }
}
