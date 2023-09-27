<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class mediaPageseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('media_pages')->truncate();
        \DB::table('media_pages')->insert([

               [
                'id'=>1,
                'page_name'=> 'Home',
                'page_slug'=>'home_page',
               ],

            [
                'id' => 2,
                'page_name' => 'Loyalty',
                'page_slug' => 'loyalty_page',
            ],

            [
                'id' => 3,
                'page_name' => 'Our Vision & Mission',
                'page_slug' => 'vision_and_mission',
            ],

            // [
            //     'id' => 4,
            //     'page_name' => 'Blog',
            //     'page_slug' => 'blog_media',
            // ],

        ]);

    }
}
