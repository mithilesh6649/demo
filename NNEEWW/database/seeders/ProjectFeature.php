<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectFeature extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $fullPath = config('common.images_path_prefix') . '/images/media/' .
         \DB::table('project_features')->truncate();
          
        \DB::table('project_features')->insert([
            [
                'name' => 'General Fitness',
                'image' => $fullPath . 'Diagnostic.svg',
                'feature_type'=>1,
                  'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'Diabetes',
                'image' => $fullPath . 'Diabetes.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'Obesity',
                'image' => $fullPath . 'obesity.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'PCOS',
                'image' => $fullPath . 'pcos.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'Cardiovascualr diseases',
                'image' => $fullPath . 'heart.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'Renal disorders',
                'image' => $fullPath . 'renal.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'What allergies',
                'image' => $fullPath . 'skin.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'Which medicines suit me?',
                'image' => $fullPath . 'Preimplantation.svg',
                 'feature_type'=>1,
                 'description'=>null,
                'status' => 1
            ],

            [
                'name' => 'Lorem Ipsum',
                'image' => $fullPath . 'mobile-14.png',
                 'feature_type'=>0,
                 'description'=>'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                  has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.</p>',
                'status' => 1
            ],
            [
                'name' => 'Lorem Ipsum',
                'image' => $fullPath . 'mobile-1.png',
                 'feature_type'=>0,
                 'description'=>'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                  has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.</p>',
                'status' => 1
            ],
            [
                'name' => 'Lorem Ipsum',
                'image' => $fullPath . 'mobile-11.png',
                 'feature_type'=>0,
                 'description'=>'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                  has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.</p>',
                'status' => 1
            ],
            [
                'name' => 'Lorem Ipsum',
                'image' => $fullPath . 'mobile-14.png',
                 'feature_type'=>0,
                 'description'=>'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                  has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book.</p>',
                'status' => 1
            ],
        ]);
    }
}
