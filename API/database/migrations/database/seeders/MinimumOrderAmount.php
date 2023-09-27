<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Branch;
use \App\Models\BranchLocality;

class MinimumOrderAmount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::each(function($obj){
            $obj->update([
                'minimum_order_amount' => rand(50, 100) / 10
            ]);

            $obj->localities->each(function($locality){
                $locality->update([
                    'minimum_order_amount' => rand(50, 100) / 10
                ]);
            });
        });
    }
}
