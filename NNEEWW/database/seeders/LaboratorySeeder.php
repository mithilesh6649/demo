<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('laboratories');

        \DB::table('laboratories')->insert([
            [
                'name' => 'Dr Lal Path Lab',
                'description' => 'This is the Dr Lal Path Lab',
                'status' => 1
            ],
            
            [
                'name' => 'Dr. Reddy Laboratory',
                'description' => 'This is the Dr. Reddy Laboratory',
                'status' => 1
            ],

            [
                'name' => 'Muthoot Lab',
                'description' => 'This is the Muthoot Lab',
                'status' => 1
            ],
        ]);
    }
}
