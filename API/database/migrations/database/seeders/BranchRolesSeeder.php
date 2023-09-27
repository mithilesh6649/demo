<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         

        \DB::table('branch_roles')->truncate();
        \DB::table('branch_roles')->insert([
                          [
                            'role_name'=> "Manager",
                            'role_tag'=>"manager",
                            'status'=> "1",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                           [
                            'role_name'=> "Front Desk 1",
                            'role_tag'=>"front_desk_1",
                            'status'=> "1",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                           [
                            'role_name'=> "Front Desk 2",
                            'role_tag'=>"front_desk_2",
                            'status'=> "1",
                            "created_at" => \Carbon\Carbon::now(),
                            "updated_at" => \Carbon\Carbon::now(),
                          ],
                            
        ]);


    }
}
