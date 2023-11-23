<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          

        \DB::table('blogs')->truncate();

        \DB::table('blogs')->insert([
            [
                'title' => 'Rooted in Science',
                'content' => 'The soul of vieroots is in its scientific research. We consider the roots of Life that goes back to Ancient Wellness Wisdom, which is more of eastern in origin. Some of the greatest treasures, which are enclosed',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/rooted.jpg',
                'status'=>1
            ],
            [
                'title' => 'Geno-Metabolic Analysis',
                'content' => 'Geno-Metabolic Analysis is far ahead of a normal genetic predisposition test, which provides information about the variations or mutations in your genes and the subsequent lifestyle diseases for which...',
                'image' =>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/geno-metabolic.jpeg',
                'status'=>1
            ]
        ]);
    }
}
