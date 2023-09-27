<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('themes')->truncate();
        \DB::table('themes')->insert([
          [
            'name'=> "Default",
            'theme'=>'<div class="product_image"><img alt="" src="https://server3.rvtechnologies.in/MMMission22/Super-Admin/public/theme/default.png" width="100%" /></div>', 
            'slug'=> "default_theme",
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],

          [
            'name'=> "Christmas",
            'theme'=>'<div class="product_image"><img alt="" src="https://server3.rvtechnologies.in/MMMission22/Super-Admin/public/theme/christmas.png" width="100%" /></div>', 
            'slug'=> "christmas_theme",
            'status'=> "0",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],


          [
            'name'=> "Hala February",
             'theme'=>'Coming Soon.....',
            'slug'=> "hala_february_theme",
            'status'=> "0",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],

          [
            'name'=> "New Year",
            'theme'=>'Coming Soon.....',
            'slug'=> "new_year_theme",
            'status'=> "0",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],


    ]);
    }
}
