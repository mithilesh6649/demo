<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LaboratoryTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        
        \DB::table('laboratory_tests')->truncate();
        
        \DB::table('laboratory_tests')->insert([
            [
                'laboratory_id' => 1,
                'test_id' => 1
            ],
            [
                'laboratory_id' => 1,
                'test_id' => 2
            ],
            [
                'laboratory_id' => 1,
                'test_id' => 3
            ],
            [
                'laboratory_id' => 1,
                'test_id' => 4
            ],
            [
                'laboratory_id' => 2,
                'test_id' => 1
            ],
            [
                'laboratory_id' => 2,
                'test_id' => 2
            ],
            
            [
                'laboratory_id' => 2,
                'test_id' => 4
            ],
            [
                'laboratory_id' => 3,
                'test_id' => 2
            ],
            [
                'laboratory_id' => 3,
                'test_id' => 4
            ],

        ]);
    }
}
