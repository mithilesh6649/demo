<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClinicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('clinicians')->truncate();

        \DB::table('clinicians')->insert([
            [
                'title' => 'Dr',
                'name' => 'Muthoot Dogra'
            ],
            [
                'title' => 'Dr',
                'name' => 'Ajay Bansal'
            ],
            [
                'title' => 'Dr',
                'name' => 'Vijay Bohra'
            ],
            [
                'title' => 'Dr',
                'name' => 'Hareem Shah'
            ],
            [
                'title' => 'Dr',
                'name' => 'Kareem'
            ],
            [
                'title' => 'Dr',
                'name' => 'Binod'
            ],
            [
                'title' => 'Dr',
                'name' => 'Viajy Malhotra'
            ],
            [
                'title' => 'Dr',
                'name' => 'Manoj Tripathi'
            ],
            [
                'title' => 'Dr',
                'name' => 'Ajay Dubey'
            ],
            [
                'title' => 'Dr',
                'name' => 'Tom Bonson'
            ],
            [
                'title' => 'Dr',
                'name' => 'Arryl Dark'
            ],
            [
                'title' => 'Dr',
                'name' => 'Kate William'
            ],
            [
                'title' => 'Dr',
                'name' => 'John Dan'
            ],
        ]);
    }
}
