<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClinicianSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('clinician_specialization_maps')->truncate();

        \DB::table('clinician_specialization_maps')->insert([
            [
                'clinician_id' => '1',
                'specialization_id' => '1'
            ],

            [
                'clinician_id' => '2',
                'specialization_id' => '4'
            ],

            [
                'clinician_id' => '3',
                'specialization_id' => '5'
            ],

            [
                'clinician_id' => '4',
                'specialization_id' => '6'
            ],

            [
                'clinician_id' => '5',
                'specialization_id' => '1'
            ],

            [
                'clinician_id' => '6',
                'specialization_id' => '3'
            ],

            [
                'clinician_id' => '7',
                'specialization_id' => '1'
            ],

            [
                'clinician_id' => '8',
                'specialization_id' => '5'
            ],

            [
                'clinician_id' => '9',
                'specialization_id' => '4'
            ],

            [
                'clinician_id' => '10',
                'specialization_id' => '6'
            ],

            [
                'clinician_id' => '11',
                'specialization_id' => '2'
            ],

            [
                'clinician_id' => '12',
                'specialization_id' => '3'
            ],

            [
                'clinician_id' => '13',
                'specialization_id' => '5'
            ],
        ]);
    }
}
