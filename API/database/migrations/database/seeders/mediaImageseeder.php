<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class mediaImageseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\DB::table('media_images')->truncate();
        \DB::table('media_images')->insert([

            // [
            //  'id'=>1,
            //  'page_slug'=> 'home_page',
            //  'page_title'=>'Home',
            //  'sections'=> 'Fragrance_image_one',
            //  'image'=>null,
            //  'image_height'=> '512',
            //  'image_width'=>'512',
            //  "created_at" => \Carbon\Carbon::now(),
            //  "updated_at" => \Carbon\Carbon::now(),
            // ],
            // [
            //  'id'=>2,
            //  'page_slug'=> 'home_page',
            //  'page_title'=>'Home',
            //  'sections'=> 'Fragrance_image_two',
            //  'image'=>null,
            //  'image_height'=> '512',
            //  'image_width'=>'512',
            //  "created_at" => \Carbon\Carbon::now(),
            //  "updated_at" => \Carbon\Carbon::now(),
            // ],
            // [
            //  'id'=>3,
            //  'page_slug'=> 'home_page',
            //  'page_title'=>'Home',
            //  'sections'=> 'Fragrance_image_three',
            //  'image'=>null,
            //  'image_height'=> '512',
            //  'image_width'=>'512',
            //  "created_at" => \Carbon\Carbon::now(),
            //  "updated_at" => \Carbon\Carbon::now(),
            // ],
            // [
            //  'id'=>4,
            //  'page_slug'=> 'home_page',
            //  'page_title'=>'Home',
            //  'sections'=> 'Fragrance_image_four',
            //  'image'=>null,
            //  'image_height'=> '512',
            //  'image_width'=>'512',
            //  "created_at" => \Carbon\Carbon::now(),
            //  "updated_at" => \Carbon\Carbon::now(),
            // ],

            //    [
            //     'id'=>5,
            //     'page_slug'=> 'home_page',
            //     'page_title'=>'Home',
            //     'sections'=> 'our_menu_offer_image_one',
            //     'image'=>null,
            //     'image_height'=> '300',
            //     'image_width'=>'500',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            //    ],
            //    [
            //     'id'=>6,
            //     'page_slug'=> 'home_page',
            //     'page_title'=>'Home',
            //     'sections'=> 'our_menu_offer_image_two',
            //     'image'=>null,
            //     'image_height'=> '300',
            //     'image_width'=>'500',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            //    ],
            //    [
            //     'id'=>7,
            //     'page_slug'=> 'home_page',
            //     'page_title'=>'Home',
            //     'sections'=> 'our_menu_offer_image_three',
            //     'image'=>null,
            //     'image_height'=> '300',
            //     'image_width'=>'500',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            //    ],
            //    [
            //     'id'=>8,
            //     'page_slug'=> 'home_page',
            //     'page_title'=>'Home',
            //     'sections'=> 'our_menu_offer_image_four',
            //     'image'=>null,
            //     'image_height'=> '300',
            //     'image_width'=>'500',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            //    ],
            //     [
            //     'id'=>9,
            //     'page_slug'=> 'home_page',
            //     'page_title'=>'Home',
            //     'sections'=> 'guest_reviews_thank_you',
            //     'image'=>null,
            //     'image_height'=> '667',
            //     'image_width'=>'1000',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            //    ],
            //    [
            //     'id'=>10,
            //     'page_slug'=> 'home_page',
            //     'page_title'=>'Home',
            //     'sections'=> 'get_started_app_image',
            //     'image'=>null,
            //     'image_height'=> '723',
            //     'image_width'=>'727',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            //    ],

            // [
            //     'id' => 11,
            //     'page_slug' => 'loyalty_page',
            //     'page_title' => 'Buddy',
            //     'sections' => 'Buddy',
            //     'image' => null,
            //     'image_height' => '200',
            //     'image_width' => '300',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => 12,
            //     'page_slug' => 'loyalty_page',
            //     'page_title' => 'Friend',
            //     'sections' => 'Friend',
            //     'image' => null,
            //     'image_height' => '200',
            //     'image_width' => '300',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => 13,
            //     'page_slug' => 'loyalty_page',
            //     'page_title' => 'Best Friend',
            //     'sections' => 'Best Friend',
            //     'image' => null,
            //     'image_height' => '200',
            //     'image_width' => '300',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            // ],
            // [
            //     'id' => 15,
            //     'page_slug' => 'loyalty_page',
            //     'page_title' => 'Sign Up',
            //     'sections' => 'sign_up',
            //     'image' => null,
            //     'image_height' => '483',
            //     'image_width' => '1728',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            // ],

            // [
            //     'id' => 14,
            //     'page_slug' => 'vision_and_mission',
            //     'page_title' => 'Our Vision & Mission',
            //     'sections' => 'Our Vision & Mission',
            //     'image' => null,
            //     'image_height' => '500',
            //     'image_width' => '500',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            // ],

            // [
            //     'id' => 16,
            //     'page_slug' => 'blog_media',
            //     'page_title' => 'Blog Media',
            //     'sections' => 'Blog',
            //     'image' => null,
            //     'image_height' => '1080',
            //     'image_width' => '1080',
            //     "created_at" => \Carbon\Carbon::now(),
            //     "updated_at" => \Carbon\Carbon::now(),
            // ],

        ]);
    }
}
