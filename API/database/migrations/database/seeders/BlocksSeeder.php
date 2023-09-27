<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
                \DB::table('blocks')->truncate();

         $blocks = [
           'Block 1','Block 2','Block 3','Block 4','Block 5','Block 6','Block 7','Block 8','Block 9','Block 10','Block 11','Block 12','Block 13','Block 14','Block 15','Block 1A','Block 3A','Block 4A','Block 7A','Block 1B','Block 3B','Block 4B','Block 7B','industrial'
           ] ;

 

        for($i = 0; $i<count($blocks); $i++) {
            
            \DB::table('blocks')->insert([
                'block' => $blocks[$i],
                'status' =>'1',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        } 


    }
}
