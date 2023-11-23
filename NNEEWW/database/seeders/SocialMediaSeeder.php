<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \DB::table('social_links')->truncate();

        \DB::table('social_links')->insert([
            [
                'name' => 'Facebook',
                'slug' => 'facebook',
                'social_url' =>'https://www.facebook.com/',
                'status' => 1,
            ],
            [
                'name' => 'Twitter',
                'slug' => 'twitter',
                'social_url' =>'https://www.twitter.com/',
                'status' => 1,
            ],
            [
                'name' => 'Instagram',
                'slug' => 'instagram',
                'social_url' =>'https://www.instagram.com/',
                'status' => 1,
            ],
            [
                'name' => 'Linkedin',
                'slug' => 'linkedin',
                'social_url' =>'https://www.linkedin.com/',
                'status' => 1,
            ],
            [
                'name' => 'Youtube',
                'slug' => 'youtube',
                'social_url' => 'https://www.youtube.com/',
                'status' => 1,
            ],

        ]);
    }
}
 