<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class RecipeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           Schema::disableForeignKeyConstraints();
         \DB::table('recipe_categories')->truncate();

        \DB::table('recipe_categories')->insert([
            [
                'title' => 'Kideny Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'Diabetes Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'Heart Disorders
 Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'Renal Disorders Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'PCOS Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'Skin & Hair Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'Kideny Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],

            [
                'title' => 'Kideny Patient Food Recipe',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/kidney_recipes.svg',
                'status'=>1
            ],
        ]);
    }
}
