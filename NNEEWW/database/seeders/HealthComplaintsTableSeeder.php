<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HealthComplaintsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('health_complaints')->truncate();
        
        \DB::table('health_complaints')->insert([
            
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/1675661923.png',
                'is_show' => 1,
                'name' => 'General Fitness',
                'status' => 1,
                'types' => 3,
                'updated_at' => now(),
            
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Diabetes.svg',
                'is_show' => 1,
                'name' => 'Diabetes',
                'status' => 1,
                'types' => 1,
                'updated_at' => now(),
            ],
        
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/obesity.svg',
                'is_show' => 1,
                'name' => 'Obesity',
                'status' => 1,
                'types' => 1,
                'updated_at' => now(),
            ],
        
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/pcos.svg',
                'is_show' => 1,
                'name' => 'PCOS',
                'status' => 1,
                'types' => 1,
                'updated_at' => now(),
            ],
        
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/heart.svg',
                'is_show' => 1,
                'name' => 'Cardiovascualr diseases',
                'status' => 1,
                'types' => 1,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/renal.svg',
                'is_show' => 1,
                'name' => 'Renal disorders',
                'status' => 1,
                'types' => 2,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/skin.svg',
                'is_show' => 1,
                'name' => 'What allergies',
                'status' => 1,
                'types' => 0,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'is_show' => 1,
                'name' => 'Which medicines suit me?',
                'status' => 1,
                'types' => 3,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => NULL,
                'is_show' => 0,
                'name' => 'No Allergies',
                'status' => 1,
                'types' => 4,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'wheat-free',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Wheat Intolerance',
                'status' => 1,
                'types' => 4,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'dairy-free',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Dairy Free',
                'status' => 1,
                'types' => 4,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'egg-free',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Allergic to egg',
                'status' => 1,
                'types' => 4,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'peanut-free',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Peanut Allergy',
                'status' => 1,
                'types' => 4,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => NULL,
                'image' => NULL,
                'is_show' => 0,
                'name' => 'No Food Preferences',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'gluten-free',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Gluten Free',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'vegetarian',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Vegetarian',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'vegan',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Vegan',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'pescatarian',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Pescatarian',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],
        
            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'sugar-conscious',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Sugar Conscious',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],

            [
                'created_at' => now(),
                'deleted_at' => NULL,
                'description' => 'paleo',
                'image' => NULL,
                'is_show' => 0,
                'name' => 'Paleo',
                'status' => 1,
                'types' => 5,
                'updated_at' => now(),
            ],
        ]);
}
}