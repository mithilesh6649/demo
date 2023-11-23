<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


       $fullPath = config('common.images_path_prefix') . '/images/media/' .
       \DB::table('health_complaints')->truncate();

       \DB::table('health_complaints')->insert([
        [
            'name' => 'General Fitness',
            'image' => $fullPath . 'Diagnostic.svg',
            'types'=>3,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'Diabetes',
            'image' => $fullPath . 'Diabetes.svg',
            'types'=>1,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'Obesity',
            'image' => $fullPath . 'obesity.svg',
            'types'=>1,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'PCOS',
            'image' => $fullPath . 'pcos.svg',
            'types'=>1,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'Cardiovascualr diseases',
            'image' => $fullPath . 'heart.svg',
            'types'=>1,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'Renal disorders',
            'image' => $fullPath . 'renal.svg',
            'types'=>2,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'What allergies',
            'image' => $fullPath . 'skin.svg',
            'types'=>0,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],

        [
            'name' => 'Which medicines suit me?',
            'image' => $fullPath . 'Preimplantation.svg',
            'types'=>3,
            'is_show'=>1,
            'description'=>null,
            'status' => 1
        ],



            // [
            //     'name' => 'None',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Diabetes',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Heart Disease',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'high Cholestrol',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Hypertension',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Thyroid',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Renal Disease',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'PCOS',
            //     'description' => 'Heart Disease is the dangerous one',
            //     'status' => 1
            // ],
   ]);
}
}
