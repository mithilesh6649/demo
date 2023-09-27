<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GiftCardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              \DB::table('gift_cards_types')->truncate();

            \DB::table('gift_cards_types')->insert([
            [
                'name' => '3',
                'name_ar' =>'3 KD',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 

            [
                'name' => '5',
                'name_ar' =>'5 KD',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 

            [
                'name' => '10',
                'name_ar' =>'10 KD',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 

            [
                'name' => '20',
                'name_ar' =>'20 KD',
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 
        
        ]);
    }
}
