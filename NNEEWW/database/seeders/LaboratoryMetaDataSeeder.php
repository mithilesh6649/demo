<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LaboratoryMetaDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('laboratory_metadata')->truncate();

        \DB::table('laboratory_metadata')->insert([
            [
                'laboratory_id' => 1,
                'open_time' => now()->parse('2022-12-11 10:00:00')->format('H:i'),
                'close_time' => now()->parse('2022-12-11 22:00:00')->format('H:i'),
                'is_partner' => 1,
                'charges' => 500,
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/strict.svg',
                'latitude'=>30.704649,
                'longitude'=>76.717873,
                'address' => 'Phase 7, Near ABC Market',
                'city' => 'Mohali',
                'state' => 'Punjab',
                'status' => 1
            ],

            [
                'laboratory_id' => 2,
                'open_time' => now()->parse('2022-12-11 8:00:00')->format('H:i'),
                'close_time' => now()->parse('2022-12-11 20:00:00')->format('H:i'),
                'is_partner' => 1,
                'charges' => 550,
                'address' => '3B2, Near XYZ Market',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/strict.svg',
                 'latitude'=>30.704649,
                'longitude'=>76.717873,
                'city' => 'Mohali',
                'state' => 'Punjab',
                'status' => 1
            ],

            [
                'laboratory_id' => 3,
                'open_time' => now()->parse('2022-12-11 9:00:00')->format('H:i'),
                'close_time' => now()->parse('2022-12-11 19:00:00')->format('H:i'),
                'is_partner' => 1,
                'charges' => 770,
                'address' => 'Phase 1, Sector 71',
                'image'=>'https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/strict.svg',
                 'latitude'=>30.704649,
                'longitude'=>76.717873,
                'city' => 'Mohali',
                'state' => 'Punjab',
                'status' => 1
            ],
        ]);
    }
}
