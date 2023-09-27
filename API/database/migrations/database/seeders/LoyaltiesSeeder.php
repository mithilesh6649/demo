<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoyaltiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          \DB::table('loyalties')->truncate();

            \DB::table('loyalties')->insert([
            [
                'loyalty_type' => 'Bronze',
                'loyalty_image' => 'https://server3.rvtechnologies.in/MMMission22/Customer/public/images/bronze-img.png',
                'applicable_from' => 1,
                'applicable_to' => 5,
                'amount_text' => 'Get BBK Rupee worth',
                'amount' => 15,
                'redeem_text' => 'Redeem BBK Rupee',
                'redeem_amount' => 10,
                'loyalty_slug' => 1,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 
            [
                'loyalty_type' => 'Silver',
                'loyalty_image' => 'https://server3.rvtechnologies.in/MMMission22/Customer/public/images/silver_img.png',
                'applicable_from' => 6,
                'applicable_to' => 12,
                'amount_text' => 'Get BBK Rupee worth',
                'amount' => 20,
                'redeem_text' => 'Redeem BBK Rupee',
                'redeem_amount' => 15,
                'loyalty_slug' => 1,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ], 

            [
                'loyalty_type' => 'Gold',
                'loyalty_image' => 'https://server3.rvtechnologies.in/MMMission22/Customer/public/images/gold_img.png',
                'applicable_from' => 13,
                'applicable_to' => 50,
                'amount_text' => 'Get BBK Rupee worth',
                'amount' => 25,
                'redeem_text' => 'Redeem BBK Rupee',
                'redeem_amount' => 20,
                'loyalty_slug' => 1,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ],
             [
                'loyalty_type' => 'Sign Up',
                'loyalty_image' => 'https://server3.rvtechnologies.in/MMMission22/Customer/public/images/banner-loyalty-two.png',
                'applicable_from' =>0,
                'applicable_to' => 0,
                'amount_text' => 'sing up now',
                'amount' => 100,
                'redeem_text' => 'N/A',
                'redeem_amount' => 0,
                'loyalty_slug' => 0,
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),

            ],  
        ]);
    }
}
