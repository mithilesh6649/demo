<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('specializations')->truncate();

        \DB::table('specializations')->insert([
            [
                'name' => 'Cardiology',
                'status' => 1
            ],

            [
                'name' => 'Gastrology',
                'status' => 1
            ],

            [
                'name' => 'Neurology',
                'status' => 1
            ],

            [
                'name' => 'Orthopedics',
                'status' => 1
            ],

            [
                'name' => 'Dermatology',
                'status' => 1
            ],

            [
                'name' => 'Radiology',
                'status' => 1
            ],

            [
                'name' => 'Ophthalmology',
                'status' => 1
            ],

            [
                'name' => 'Pathology',
                'status' => 1
            ],
        ]);
    }
}
