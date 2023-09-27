<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               \DB::table('designations')->truncate();

            \DB::table('designations')->insert([
            [
            'designation' => 'Branch Manager',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Conti- Chinese Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Pickup / Order Taker',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Supervisor / Cashier',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Tandoor Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Take Away In Charge',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Asst. Chinese Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Asst. Manager',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Asst. Take Away',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Asst Chef',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Area Manager',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

            [
            'designation' => 'Chef',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ], 

            [
            'designation' => 'Chinese Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  


            [
            'designation' => 'Computer Operator',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Curry Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  
            [
            'designation' => 'Continental Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  
            [
            'designation' => 'Deep fryer / Helper',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  
            [
            'designation' => 'Dish Washer',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  
            [
            'designation' => 'DoorMan',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  
            [
            'designation' => 'Driver',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],    

            [
            'designation' => 'Grill / Tandoor Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  

            [
            'designation' => 'Grill Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ], 

            [
            'designation' => 'Helper',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],    

            [
            'designation' => 'Kitchen Helper',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],    

            [
            'designation' => 'Order Taker',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],    


            [
            'designation' => 'Pantry Man',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],    

            [
            'designation' => 'Pot Washer',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],    

            [
            'designation' => 'Store Keeper',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  

            [
            'designation' => 'Sweet Maker / Pantryman',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  

            [
            'designation' => 'Tandoo Cook / Chinese',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  


            [
            'designation' => 'Tandoo Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],  

            [
            'designation' => 'Waiter',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

            [
            'designation' => 'Waiter / Take Away Boy',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],


            [
            'designation' => 'Waitress',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],


            [
            'designation' => 'Supervisor',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'Captain',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'RiceMaker / Cleaner',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Asst. Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Maintenance',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
             [
            'designation' => 'Asst. Branch Manager',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
              [
            'designation' => 'Asst.Supervisor',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
             [
            'designation' => 'Call Center',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
              [
            'designation' => 'RiceMaker',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
              [
            'designation' => 'Store / Helper',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
              [
            'designation' => 'Asst. Tandoor Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Curry / Continental Cook',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
            [
            'designation' => 'Catering Incharge',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
           [
            'designation' => 'Asst. Supervisor',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
          [
            'designation' => 'T.A Pickup',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'Pickup / Waiter',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'Maintenance & Legal',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'IT & Mis Manager',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'HOD HR',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'HOD Accounts',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

             [
            'designation' => 'Business Analys',
            'status' => 1,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],
 

             
        ]);
    }
}
