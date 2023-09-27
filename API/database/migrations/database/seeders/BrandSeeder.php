<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             \DB::table('brands')->truncate();
        \DB::table('brands')->insert([
            [
            'title_en'=>"INDIAN CHINESE",
            'title_ar'=>"هندي صيني", 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

            [
            'title_en'=>"HAVELI",
            'title_ar'=>"حويلي", 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

            [
            'title_en'=>"QUICK BITES",
            'title_ar'=>"لقمة سريعة", 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],


            [
            'title_en'=>"MULTI CUISINE",
            'title_ar'=>"ملتي كوزين", 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

            [
            'title_en'=>"ELITE INDIAN TWIST",
            'title_ar'=>"ملتقي النخبة الهندي", 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            
            [
            'title_en'=>"EXOTICA",
            'title_ar'=>"إكزوتيكا", 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ], 


    ]);

    } 
}
