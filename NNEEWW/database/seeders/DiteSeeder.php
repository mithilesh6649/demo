<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class DiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Schema::disableForeignKeyConstraints();
         \DB::table('diets')->truncate();

        \DB::table('diets')->insert([
            [
                'diet_category_id' =>1,           
                'title'=>'Ketogenic Strict',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/fruit-11.svg',
                'amount'=>1299,
                'status'=>1,
            ],

          

            [
                'diet_category_id' =>1,           
                'title'=>'Ketogenic Strict',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/fruit-3.svg',
                'amount'=>1499,
                'status'=>1,
            ],

            [
                'diet_category_id' =>1,           
                'title'=>'Ketogenic Strict',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/fruit-11.svg',
                'amount'=>1299,
                'status'=>1,
            ],

            [
                'diet_category_id' =>2,           
                'title'=>'Detox deit',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/fruit-11.svg',
                'amount'=>1299,
                'status'=>1,
            ],

            [
                'diet_category_id' =>2,           
                'title'=>'Immunity booster',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/fruit-11.svg',
                'amount'=>1299,
                'status'=>1,
            ]
,
            [
                'diet_category_id' =>2,           
                'title'=>'Memory protection',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/fruit-11.svg',
                'amount'=>1299,
                'status'=>1,
            ],

                     [
                'diet_category_id' =>3,           
                'title'=>'Kapha',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/kapha.svg',
                'amount'=>1299,
                'status'=>1,
            ],

                     [
                'diet_category_id' =>3,           
                'title'=>'Pitha',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/pitta.svg',
                'amount'=>1299,
                'status'=>1,
            ],

                     [
                'diet_category_id' =>3,           
                'title'=>'Vatha',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/designs/img/vatta.svg',
                'amount'=>1299,
                'status'=>1,
            ],




        ]);
    }
}
