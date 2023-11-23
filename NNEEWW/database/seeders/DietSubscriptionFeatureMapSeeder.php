<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class DietSubscriptionFeatureMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Schema::disableForeignKeyConstraints();
         \DB::table('diet_subscription_feature_maps')->truncate();

        \DB::table('diet_subscription_feature_maps')->insert([
            [
                'feature_id' => 'KETO / LOW CARB',
                'diet_plan_subscription_id' => 'KETO / LOW CARB',            
            ],
        ]);  
    }
}
