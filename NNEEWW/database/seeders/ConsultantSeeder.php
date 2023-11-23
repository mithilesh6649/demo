<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('consultants')->truncate();

        \DB::table('consultants')->insert([
            [
                'type' => 'Doctors',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/docter.jpg',
                'free' => 0,
                'discount' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Scientists',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/scintice.jpg',
                'free' => 1,
                'discount' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Clinical Nutritionists',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/nutertion.jpg',
                'free' => 1,
                'discount' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Partner labs',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/lab.jpg',
                'free' => 0,
                'discount' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
