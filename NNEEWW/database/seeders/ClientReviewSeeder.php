<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        \DB::table('testimonials')->truncate();

        \DB::table('testimonials')->insert([
            [
                'name' => 'Client Name',
                'title' => 'Lorem Ipsum is simply dummy',
                'rating'=>5,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the  standard dummy text ever since the 1500s when an unknown printer
                    ',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/testimonial-2.jpg',
                'status'=>1
            ],

              [
                'name' => 'Client Name',
                'title' => 'Lorem Ipsum is simply dummy',
                'rating'=>5,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the  standard dummy text ever since the 1500s when an unknown printer
                    ',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/testimonial-1.jpg',
                'status'=>1
            ],

             [
                'name' => 'Client Name',
                'title' => 'Lorem Ipsum is simply dummy',
                'rating'=>5,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the  standard dummy text ever since the 1500s when an unknown printer
                    ',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/testimonial-3.jpg',
                'status'=>1
            ],

             [
                'name' => 'Client Name',
                'title' => 'Lorem Ipsum is simply dummy',
                'rating'=>5,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the  standard dummy text ever since the 1500s when an unknown printer
                    ',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/testimonial-4.jpg',
                'status'=>1
            ],

             [
                'name' => 'Client Name',
                'title' => 'Lorem Ipsum is simply dummy',
                'rating'=>5,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the  standard dummy text ever since the 1500s when an unknown printer
                    ',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/testimonial-4.jpg',
                'status'=>1
            ],


            
        ]);
    }
}
