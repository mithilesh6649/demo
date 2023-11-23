<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class DietPlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('features')->truncate();
        \DB::table('features')->insert([

            [
               'name'  =>'App',
               'slug'  => 'app',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'BMI tracking',
               'slug'  => 'bmi_tracking',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Weight tracking',
               'slug'  => 'weight_tracking',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Macronutrient tracking',
               'slug'  => 'macronutrient_tracking',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Recipes',
               'slug'  => 'recipes',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Upload biochemical tests',
               'slug'  => 'upload_biochemical_tests',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Clinical data registry',
               'slug'  => 'clinical_data_registry',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Graphical progress',
               'slug'  => 'graphical_progress',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Genomic tests',
               'slug'  => 'genomic_tests',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Personalized diet plans',
               'slug'  => 'personalized_diet_plans',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Diet Plans for chronic diseases',
               'slug'  => 'diet_plans_for_chronic_diseases',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Fitness guide',
               'slug'  => 'fitness_guide',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Keto meal plan',
               'slug'  => 'keto_meal_plan',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Intermittent fasting meal plan',
               'slug'  => 'intermittent_fasting_meal_plan',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Detox meal plan',
               'slug'  => 'detox_meal_plan',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Immune booster diet plan',
               'slug'  => 'immune_booster_diet_plan',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Doctor consultation',
               'slug'  => 'doctor_consultation',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Scientist consultations',
               'slug'  => 'scientist_consultations',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Clinical Nutritionist consultations',
               'slug'  => 'clinical_nutritionist_consultations',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
           [
               'name'  =>'Partner lab',
               'slug'  => 'partner_lab',
               'created_at' => now(),
               'status'=>1, 
               'deleted_at' => now()
           ],
       ]);


    }
}
