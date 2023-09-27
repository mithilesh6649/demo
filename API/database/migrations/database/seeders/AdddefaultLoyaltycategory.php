<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class AdddefaultLoyaltycategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        \DB::table('menu_categories')->where('category_type','loyality')->delete();

        \DB::table('menu_categories')->insert([
            [
                'category_type' => 'loyality',
                'name_en' => 'Loyalty',
                'name_ar' => 'الولاء',
                'category_position' =>1,
                'status'=>1
                
            ],
            [
                'category_type' => 'most_selling',
                'name_en' => 'Most Selling',
                'name_ar' => 'الأكثر مبيعًا',
                'category_position' =>2,
                'status'=>1
                
            ], 
        ]);
        
    }
}
