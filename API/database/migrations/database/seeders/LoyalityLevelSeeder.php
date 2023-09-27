<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoyalityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
               \DB::table('loyality_levels')->truncate();

            \DB::table('loyality_levels')->insert([
            [
                'loyalty_level' => 'Buddy',
                'points_from' => 0,
                'points_to' => 80, 
                'regular_items_points' => 30,
                'offers_items_points' => 10,
                'position' => 1,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 

             [
                'loyalty_level' => 'Friend',
                'points_from' => 81,
                'points_to' => 200, 
                'regular_items_points' => 40,
                'offers_items_points' => 10,
                'position' => 2,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 


             [
                'loyalty_level' => 'Best Friend',
                'points_from' => 201,
                'points_to' =>  null, 
                'regular_items_points' => 50,
                'offers_items_points' => 10,
                'position' => 3,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 
        ]);


    }
}
