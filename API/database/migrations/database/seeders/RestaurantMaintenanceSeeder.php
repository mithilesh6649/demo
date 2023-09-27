<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantMaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('restaurant_maintenance_sub_categories')->truncate();
		\DB::table('restaurant_maintenance_sub_categories')->insert([

            [
                "description" => 'REP.& MAINT. (BUILDING & STRUCTURE)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (KITCHEN EQUIP)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (KITCHEN ELECTRICAL)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (REST EQUIP)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (SIGN BOARD)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (STAFF ACCOM)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'AMC-AIR CONDITIONING EXP',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'AMC-KITCHEN HOOD EXP',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'AMC-FIRE SAFETY SYSTEM',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'CHAIR (STITCHING & MAINT.)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (DRAIN CLEANING SERVICE)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (AIR CONDITIONING KITCH/REST)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'MAINT. FLOWER FOR RESTAURANT',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'AMC-ELEVATOR & LIFT',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'TANDOOR (NEW)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                "description" => 'REP.& MAINT. (GAS SYSTEM & PIPELINE)',
                "section" => "REP.& MAINT",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

        ]);

    }
}
