<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionSubPlanPricingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscription_sub_plan_pricings')->delete();
        
        \DB::table('subscription_sub_plan_pricings')->insert(array (
            0 => 
            array (
                'amount' => 24000.0,
                'created_at' => '2023-05-18 05:11:33',
                'deleted_at' => NULL,
                'diet_id' => 10,
                'discount' => 37,
                'duration' => 6,
                'id' => 1,
                'status' => 1,
                'updated_at' => '2023-05-18 05:11:33',
            ),
            1 => 
            array (
                'amount' => 12000.0,
                'created_at' => '2023-05-18 05:11:33',
                'deleted_at' => NULL,
                'diet_id' => 10,
                'discount' => 25,
                'duration' => 3,
                'id' => 2,
                'status' => 1,
                'updated_at' => '2023-05-18 05:11:33',
            ),
            2 => 
            array (
                'amount' => 5000.0,
                'created_at' => '2023-05-18 05:11:34',
                'deleted_at' => NULL,
                'diet_id' => 10,
                'discount' => 20,
                'duration' => 1,
                'id' => 3,
                'status' => 1,
                'updated_at' => '2023-05-18 05:11:34',
            ),
            3 => 
            array (
                'amount' => 63000.0,
                'created_at' => '2023-05-18 05:21:36',
                'deleted_at' => NULL,
                'diet_id' => 11,
                'discount' => 38,
                'duration' => 12,
                'id' => 4,
                'status' => 1,
                'updated_at' => '2023-05-18 05:21:36',
            ),
            4 => 
            array (
                'amount' => 42000.0,
                'created_at' => '2023-05-18 05:21:37',
                'deleted_at' => NULL,
                'diet_id' => 11,
                'discount' => 40,
                'duration' => 6,
                'id' => 5,
                'status' => 1,
                'updated_at' => '2023-05-18 05:21:37',
            ),
            5 => 
            array (
                'amount' => 23000.0,
                'created_at' => '2023-05-18 05:21:38',
                'deleted_at' => NULL,
                'diet_id' => 11,
                'discount' => 34,
                'duration' => 2,
                'id' => 6,
                'status' => 1,
                'updated_at' => '2023-05-18 05:21:38',
            ),
            6 => 
            array (
                'amount' => 84000.0,
                'created_at' => '2023-05-18 05:43:12',
                'deleted_at' => NULL,
                'diet_id' => 12,
                'discount' => 42,
                'duration' => 12,
                'id' => 7,
                'status' => 1,
                'updated_at' => '2023-05-18 05:43:12',
            ),
            7 => 
            array (
                'amount' => 54000.0,
                'created_at' => '2023-05-18 05:43:13',
                'deleted_at' => NULL,
                'diet_id' => 12,
                'discount' => 38,
                'duration' => 6,
                'id' => 8,
                'status' => 1,
                'updated_at' => '2023-05-18 05:43:13',
            ),
            8 => 
            array (
                'amount' => 36000.0,
                'created_at' => '2023-05-18 05:43:14',
                'deleted_at' => NULL,
                'diet_id' => 12,
                'discount' => 37,
                'duration' => 3,
                'id' => 9,
                'status' => 1,
                'updated_at' => '2023-05-18 05:43:14',
            ),
            9 => 
            array (
                'amount' => 90000.0,
                'created_at' => '2023-05-18 06:01:50',
                'deleted_at' => NULL,
                'diet_id' => 13,
                'discount' => 20,
                'duration' => 12,
                'id' => 10,
                'status' => 1,
                'updated_at' => '2023-05-18 06:01:50',
            ),
            10 => 
            array (
                'amount' => 75000.0,
                'created_at' => '2023-05-18 06:01:50',
                'deleted_at' => NULL,
                'diet_id' => 13,
                'discount' => 44,
                'duration' => 6,
                'id' => 11,
                'status' => 1,
                'updated_at' => '2023-05-18 06:01:50',
            ),
        ));
        
        
    }
}