<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class DiteCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           Schema::disableForeignKeyConstraints();
         \DB::table('diet_categories')->truncate();

        \DB::table('diet_categories')->insert([
            [
                'title' => 'KETO / LOW CARB',           
                'status'=>1
            ],

            [
                'title' => 'Anti-aging / Peotective diets',           
                'status'=>1
            ],

            [
                'title' => 'Ayurvedic diet plans',           
                'status'=>1
            ],
        ]);
    }
}
