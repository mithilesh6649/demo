<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class DietSubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Schema::disableForeignKeyConstraints();
         $fullPath = env('IMAGE_BASE_URL') . '/images/medias/' .
         \DB::table('diet_plan_subscriptions')->truncate();
          
        \DB::table('diet_plan_subscriptions')->insert([
              
             [
                'name' => 'General Diet Plan',
                'description' => 'Based on your BMI score, customize your diet plan',
                'image' => $fullPath . 'general_diet_plansmk.png',
                'monthly_amount'=>null,
                'quaterly_amount'=>null,
                'yearly_amount'=>null,
                'discount'=>null,
                'is_free'=>1,
                'status' => 1
            ],

            [
                'name' => 'Metabolic Diet Plan',
                'description' => 'Based on your clinical reports, our experts design specific diet plans for recovery.',
                'image' => $fullPath . 'metabolic_diet_plans_mk.png',
                'monthly_amount'=>700,
                'quaterly_amount'=>600,
                'yearly_amount'=>540,
                'discount'=>null,
                'is_free'=>0,
                'status' => 1
            ],

            [
                'name' => 'DNA-Metabolic Diet Plan',
                'description' => 'Based on your DNA & clinical reports, our experts design personalized diet plans.',
                'image' => $fullPath . 'dna_metabolic_diet_plans_mk.png',
                'monthly_amount'=>900,
                'quaterly_amount'=>700,
                'yearly_amount'=>550,
                'discount'=>null,
                'is_free'=>0,
                'status' => 1
            ],

            [
                'name' => 'Specialized Diet Plans',
                'description' => 'Based on your specific health needs, our experts design tailored diet plans.',
                'image' => $fullPath . 'specialized_diet_plans_mk.png',
                'monthly_amount'=>1000,
                'quaterly_amount'=>800,
                'yearly_amount'=>750,
                'discount'=>null,
                'is_free'=>0,
                'status' => 1
            ], 

           
 
        ]);
    }
}
