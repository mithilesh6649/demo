<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OurTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $fullPath = env('IMAGE_BASE_URL') . '/images/media/' .
         \DB::table('our_teams')->truncate();
          
        \DB::table('our_teams')->insert([
            [
                'name' => 'Deva Kusuluri',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum
                        has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book.<br><br>

                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                        has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book.',
                'experience' => 10,
                'is_ceo' => 1,
                'image' => $fullPath . 'ceo.jpg',
                'status' => 1
            ],

            [
                'name' => 'Amen Doe',
                'description' => '',
                'experience' => 15,
                'is_ceo' => 0,
                'image' => $fullPath . 'team-1.png',
                'status' => 1
            ],

             [
                'name' => 'Jame John',
                'description' => '',
                'experience' => 18,
                'is_ceo' => 0,
                'image' => $fullPath . 'team-2.png',
                'status' => 1
            ],

             [
                'name' => 'David Doe',
                'description' => '',
                'experience' => 23,
                'is_ceo' => 0,
                'image' => $fullPath . 'team-3.png',
                'status' => 1
            ],

             [
                'name' => 'John Doe',
                'description' => '',
                'experience' => 25,
                'is_ceo' => 0,
                'image' => $fullPath . 'team-4.png',
                'status' => 1
            ], 

           
 
        ]);
    }
}
