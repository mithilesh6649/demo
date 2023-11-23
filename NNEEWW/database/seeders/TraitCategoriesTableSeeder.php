<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TraitCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('trait_categories')->delete();
        
        \DB::table('trait_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Nutritional',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Exercise',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Addiction',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Dermatology',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Hormonal',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Lifestyle',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Neurology',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:30:59',
                'updated_at' => '2023-04-07 07:30:59',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Ophthalmology',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Personality',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Renal',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'Gastrointestinal',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            11 => 
            array (
                'id' => 12,
                'title' => 'Immunology',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            12 => 
            array (
                'id' => 13,
                'title' => 'Allergy',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            13 => 
            array (
                'id' => 14,
                'title' => 'Dental',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            14 => 
            array (
                'id' => 15,
                'title' => 'IVF & Pregnancy Loss*',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:00',
                'updated_at' => '2023-04-07 07:31:00',
            ),
            15 => 
            array (
                'id' => 16,
                'title' => 'Pulmonary',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
            16 => 
            array (
                'id' => 17,
                'title' => 'Circadian Rhythm',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
            17 => 
            array (
                'id' => 18,
                'title' => 'Vaccinomics',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
            18 => 
            array (
                'id' => 19,
                'title' => 'Cardiology',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
            19 => 
            array (
                'id' => 20,
                'title' => 'Bone Health & Disorders',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
            20 => 
            array (
                'id' => 21,
                'title' => 'Hematological',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
            21 => 
            array (
                'id' => 22,
                'title' => 'Infectious Diseases',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-04-07 07:31:01',
                'updated_at' => '2023-04-07 07:31:01',
            ),
        ));
        
        
    }
}