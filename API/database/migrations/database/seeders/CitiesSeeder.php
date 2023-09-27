<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{ 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cities')->truncate();

         $cites = [
'Abdullah Al-Salem', 
'Adailiya', 
'Daiya', 
'Faiha', 
'Kaifan', 
'Khaldiya', 
'Mansouriya', 
'Nuzha', 
'Qadsiya', 
'Qortuba',
'Rawda', 
'Surra', 
'Yarmouk', 
'Al-Bedae', 
'Bayan', 
'Hawally', 
'Hitteen', 
'Jabriya', 
'Maidan Hawally', 
'Ministries Zone', 
'Mishrif', 
'Mubarak Al-Abdullah - West Mishref', 
'Rumaithiya', 
'Salam', 
'Salmiya', 
'Salwa', 
'Shaab', 
'Shuhada', 
'Siddiq', 
'Zahra', 
'Bneid Al Qar', 
'Dasma', 
'Dasman', 
'Kuwait City', 
'Mirqab', 
'Qibla',
'Salhiya', 
'Shamiya', 
'Sharq',
'Abdullah Al-Mubarak - West Jeleeb', 
'Nahda', 
'Shuwaikh Residential', 
'Airport', 
'Andalous', 
'Ardhiya 4', 
'Ardhiya', 
'Ardiya Small Industrial', 
'Ardiya Storage Zone', 
'Ashbeliah', 
'Dhajeej', 
'Farwaniya', 
'Ferdous', 
'Khaitan', 
'Omariya', 
'Rabiya', 
'Rehab', 
'Sabah Al-Nasser', 
'Abu Ftaira', 
'Abu Hasaniya', 
'Adan', 
'Al Masayel', 
'Al-Qurain', 
'Al-Qusour', 
'Fnaitess', 
'Messila', 
'Mubarak Al-Kabir', 
'Sabah Al-Salem', 
'Abu Halifa', 
'Dhaher', 
'Egaila', 
'Fahad Al Ahmed', 
'Fintas', 
'Hadiya', 
'Jaber Al Ali', 
'Mahboula', 
'Mangaf', 
'Riqqa', 
'Al-Ahmadi', 
'Ali Sabah Al-Salem - Umm Al Hayman', 
"Al-Julaia'a", 
'Bnaider', 
'Fahaheel', 
'Khairan', 
'Magwa', 
'Mina Abdullah', 
'Nuwaiseeb', 
'Sabah Al Ahmad 1', 
'Sabah Al Ahmad 2', 
'Sabah Al Ahmad 3', 
'Sabah Al Ahmad 4', 
'Sabah Al Ahmad 5', 
'Sabah Al Ahmad Marine City', 
'Sabahiya', 
'Shuaiba Port', 
'South Sabahiya', 
'Wafra farms', 
'Wafra residential', 
'Zour', 
'Al Naeem', 
'Doha', 
'Jaber Al Ahmad', 
'North West Sulaibikhat', 
'Sulaibikhat', 
'Amgarah Industrial', 
'Jahra Area', 
'Nasseem', 
'Oyoun', 
'Qasr', 
'Saad Al Abdullah', 
'Sulaibiya Industrial 1', 
'Sulaibiya Industrial 2', 
'Sulaibiya Residential', 
'Sulaibiya', 
'Taima', 
'Waha', 
'Qairawan - South Doha'
] ;

 

        for($i = 0; $i<count($cites); $i++) {
            
            \DB::table('cities')->insert([
                'city' => $cites[$i],
                'status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        } 
     


        



    }
}
