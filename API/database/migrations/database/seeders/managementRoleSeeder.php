<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class managementRoleSeeder extends Seeder
{
  
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('management_roles')->truncate();
        \DB::table('management_roles')->insert([
            [
              'id'=>1,
              'name_en'=>'Chairman',
              'name_ar'=>'رئيس',
              'status'=>1,
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),
            ],
            [
              'id'=>2,
              'name_en'=>'Partner',
              'name_ar'=>'شريك',
              'status'=>1,
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),
            ],
            [
              'id'=>3,
              'name_en'=>'Managing Partner',
              'name_ar'=>'شريك اداري',
              'status'=>1,
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),
            ],
            [
              'id'=>4,
              'name_en'=>'Director / Partner',
              'name_ar'=>'مدير / شريك',
              'status'=>1,
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),
            ],

          ]);
    }
}
