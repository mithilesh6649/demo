<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('statuses')->truncate();
        \DB::table('statuses')->insert([
            [
                 'name'  =>'Requested',
                 'module_name'  => 'Appointment',
                 'slug'  => 'requested',
                 'color' => '#ff00e1',
                 'created_at' => now(),
                 'deleted_at' => now()
            ],
            [
                 'name'  =>'Scheduled',
                 'module_name'  => 'Appointment',
                 'slug'  => 'scheduled',
                 'color' => '#ff00e2',
                 'created_at' => now(),
                 'deleted_at' => now()
            ],
            [
                 'name'  =>'Appointment End',
                 'module_name'  => 'Appointment',
                 'slug'  => 'appointmentend',
                 'color' => '#ff00e3',
                 'created_at' => now(),
                 'deleted_at' => now()
            ], 
            [
                'name'  =>'Account Deleted',
                'module_name'  => 'Account',
                'slug'  => 'account_deleted',
                'color' => '#dc3545',
                'created_at' => now(),
                'deleted_at' => now()
           ], 

           [
                'name'  =>'Active',
                'module_name'  => 'Account',
                'slug'  => 'account_status',
                'color' => '#856404',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Inactive',
                'module_name'  => 'Account',
                'slug'  => 'account_status',
                'color' => '#856404',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Approved',
                'module_name'  => 'Document',
                'slug'  => 'document_approved',
                'color' => '#90EE90',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Rejected',
                'module_name'  => 'Document',
                'slug'  => 'document_rejected',
                'color' => '#FFCCCB',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Under Review',
                'module_name'  => 'Document',
                'slug'  => 'document_under_review',
                'color' => '#fff3cd',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Reviewing',
                'module_name'  => 'Tickets',
                'slug'  => 'ticket_reviewing',
                'color' => '#fff3cd',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Closed',
                'module_name'  => 'Tickets',
                'slug'  => 'ticket_closed',
                'color' => '#fff3cd',
                'created_at' => now(),
                'deleted_at' => now()
            ],

            [
                'name'  =>'Appointment Cancelled',
                'module_name'  => 'Appointment',
                'slug'  => 'appointmentcancel',
                'color' => '#ff00e3',
                'created_at' => now(),
                'deleted_at' => now()
           ], 
        ]);

       
    }
}
