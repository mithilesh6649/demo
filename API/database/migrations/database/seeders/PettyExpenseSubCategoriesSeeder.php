<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PettyExpenseSubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('daily_petty_expense_sub_categories')->truncate();
		\DB::table('daily_petty_expense_sub_categories')->insert([
			[
				'category_id' => 1,
				'sub_cat_name' => 'Gas Cylinder Refilling',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase Bread',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase Grocery',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Charcoal',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Dairy Products',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Fresh Meat',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Fresh Vegetable',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Fresh Leaves',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Fish & Prawns',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 2,
				'sub_cat_name' => 'Purchase-Soft Drinks/Bevgs',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],

			[
				'category_id' => 3,
				'sub_cat_name' => 'Vehicle-Fuel',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 3,
				'sub_cat_name' => 'Vehicle-Repair/Maint',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],

			[
				'category_id' => 4,
				'sub_cat_name' => 'Repair & Maint.(Kitchen)',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 4,
				'sub_cat_name' => 'Repair & Maint.(Electrical)',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 4,
				'sub_cat_name' => 'Repair & Maint.(Others)',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],

			[
				'category_id' => 5,
				'sub_cat_name' => 'Staff Accomodation(Allowance)',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
			[
				'category_id' => 6,
				'sub_cat_name' => 'Giveaway(Haras)',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 7,
				'sub_cat_name' => 'Telephone/Mobile',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 8,
				'sub_cat_name' => 'Staff Medical',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 9,
				'sub_cat_name' => 'Legal Fees Others',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 10,
				'sub_cat_name' => 'Office Stationery',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 11,
				'sub_cat_name' => 'Electricity Bill',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 12,
				'sub_cat_name' => 'Wages-Staff Exp.(Casual)',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],[
				'category_id' => 13,
				'sub_cat_name' => 'Taxi & Parking',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
			[
				'category_id' => 14,
				'sub_cat_name' => 'Exp.',
				'status' => 1,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
			[
				'category_id' => 15,
				'sub_cat_name' => 'PV-Voucher',
				'status' => 0,
				"created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
			],
		]);
    }
}
