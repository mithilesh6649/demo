<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClinicianMetaDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clinician_metadata')->truncate();

        \DB::table('clinician_metadata')->insert([
            [
                'clinician_id' => 1,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'IVY Hospital',
                'open_time' => '10:00',
                'close_time' => '20:00',
                'currency' => '$',
                'charges' => 500,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 2,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Fortis Hospital',
                'open_time' => '8:00',
                'close_time' => '15:00',
                'currency' => '$',
                'charges' => 600,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 3,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Maxx Hospital',
                'open_time' => '11:00',
                'close_time' => '19:00',
                'currency' => '$',
                'charges' => 650,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 4,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 5,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 6,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 7,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 8,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 9,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 10,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 11,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
            [
                'clinician_id' => 12,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],

            [
                'clinician_id' => 13,
                'description' => 'I am a Doctor',
                'image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/Preimplantation.svg',
                'working_area' => 'Birla Hospital',
                'open_time' => '10:00',
                'close_time' => '21:00',
                'currency' => '$',
                'charges' => 700,
                'charges_per' => 'hr',
            ],
        ]);

    }
}
