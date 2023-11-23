<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DietSubPlanSubscriptionMapsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('diet_sub_plan_subscription_maps')->delete();
        
        \DB::table('diet_sub_plan_subscription_maps')->insert(array (
            0 => 
            array (
                'created_at' => '2023-05-18 05:11:32',
                'diet_id' => 10,
                'diet_plan_subscription_id' => 2,
                'id' => 1,
                'updated_at' => '2023-05-18 05:11:32',
            ),
            1 => 
            array (
                'created_at' => '2023-05-18 05:21:36',
                'diet_id' => 11,
                'diet_plan_subscription_id' => 3,
                'id' => 2,
                'updated_at' => '2023-05-18 05:21:36',
            ),
            2 => 
            array (
                'created_at' => '2023-05-18 05:43:11',
                'diet_id' => 12,
                'diet_plan_subscription_id' => 3,
                'id' => 3,
                'updated_at' => '2023-05-18 05:43:11',
            ),
            3 => 
            array (
                'created_at' => '2023-05-18 06:01:49',
                'diet_id' => 13,
                'diet_plan_subscription_id' => 3,
                'id' => 4,
                'updated_at' => '2023-05-18 06:01:49',
            ),
        ));
        
        
    }
}