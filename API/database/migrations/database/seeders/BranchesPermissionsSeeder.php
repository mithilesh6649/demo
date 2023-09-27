<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branches_permissions')->truncate();
       // \DB::table('branch_assigned_permissions')->truncate();
        \DB::table('branches_permissions')->insert([
            // Users management
            [
                'name' => 'New Orders View',
                'slug' => 'new_orders_view',
                'module_name' => 'New Orders View',
                'module_slug' => 'order_management',
                'description' => 'Order Management',
                'status' => 1
            ],
            [
                'name' => 'Accept Orders',
                'slug' => 'accept_orders',
                'module_name' => 'Accept Orders',
                'module_slug' => 'order_management',
                'description' => 'Order Management',
                'status' => 1
            ],
            [
                'name' => 'Online Order Management',
                'slug' => 'order_manage',
                'module_name' => 'Online Order Management',
                'module_slug' => 'order_management',
                'description' => 'Order Management',
                'status' => 1
            ],

              [
                'name' => 'Menu Category View',
                'slug' => 'menu_category_view',
                'module_name' => 'Menu  Management',
                'module_slug' => 'menu_management',
                'description' => 'Menu Management',
                'status' => 1
            ],

              [
                'name' => 'Menu Category Enable/Disable',
                'slug' => 'menu_category_edit',
                'module_name' => 'Menu  Management',
                'module_slug' => 'menu_management',
                'description' => 'Menu Management',
                'status' => 1
            ],

              [
                'name' => 'Menu Item View',
                'slug' => 'menu_items_view',
                'module_name' => 'Menu  Management',
                'module_slug' => 'menu_management',
                'description' => 'Menu Management',
                'status' => 1
            ],

              [
                'name' => 'Menu Items Enable/Disable',
                'slug' => 'menu_items_edit',
                'module_name' => 'Menu  Management',
                'module_slug' => 'menu_management',
                'description' => 'Menu Management',
                'status' => 1
            ],
          
            [
                'name' => 'Customer Management',
                'slug' => 'customer_manage',
                'module_name' => 'Customer Management',
                'module_slug' => 'customer_management',
                'description' => 'Customer Management',
                'status' => 1
            ],


            [
                'name' => 'Loyalties View',
                'slug' => 'loyalties_view',
                'module_name' => 'Loyalties Management',
                'module_slug' => 'loyalties_management',
                'description' => 'Loyalties Management',
                'status' => 1
            ],

            [
                'name' => 'Loyalties Edit',
                'slug' => 'loyalties_edit',
                'module_name' => 'Loyalties Management',
                'module_slug' => 'loyalties_management',
                'description' => 'Loyalties Management',
                'status' => 1
            ],

            [
                'name' => 'Loyalties Add',
                'slug' => 'loyalties_add',
                'module_name' => 'Loyalties Management',
                'module_slug' => 'loyalties_management',
                'description' => 'Loyalties Management',
                'status' => 1
            ],



            [
                'name' => 'Branch Localities View',
                'slug' => 'branch_localities_view',
                'module_name' => 'Branch Localities Management',
                'module_slug' => 'branch_localities_management',
                'description' => 'Branch Localities Management',
                'status' => 1
            ],
            
             [
                'name' => 'Branch Localities Enable/Disable',
                'slug' => 'branch_localities_edit',
                'module_name' => 'Branch Localities Management',
                'module_slug' => 'branch_localities_management',
                'description' => 'Branch Localities Management',
                'status' => 1
            ],

            [
                'name' => 'Daily Sales Reports View',
                'slug' => 'daily_sales_reports_view',
                'module_name' => 'Daily Sales Reports Management',
                'module_slug' => 'daily_sales_reports_management',
                'description' => 'Daily Sales Reports  Management',
                'status' => 1
            ],

             [
                'name' => 'Daily Sales Reports Edit',
                'slug' => 'daily_sales_reports_edit',
                'module_name' => 'Daily Sales Reports Management',
                'module_slug' => 'daily_sales_reports_management',
                'description' => 'Daily Sales Reports  Management',
                'status' => 1
            ],


            [
                'name' => 'Daily Sales Reports Add',
                'slug' => 'daily_sales_reports_add',
                'module_name' => 'Daily Sales Reports Management',
                'module_slug' => 'daily_sales_reports_management',
                'description' => 'Daily Sales Reports  Management',
                'status' => 1
            ],


           

                 [
                'name' => 'Daily Petty Expense View',
                'slug' => 'daily_petty_expense_view',
                'module_name' => 'Daily Petty Expense Management',
                'module_slug' => 'daily_petty_expense_management',
                'description' => 'Daily Petty Expense  Management',
                'status' => 1
            ],
            



                [
                'name' => 'Daily Petty Expense Edit',
                'slug' => 'daily_petty_expense_edit',
                'module_name' => 'Daily Petty Expense Management',
                'module_slug' => 'daily_petty_expense_management',
                'description' => 'Daily Petty Expense  Management',
                'status' => 1
            ],

              [
                'name' => 'Daily Petty Expense Add',
                'slug' => 'daily_petty_expense_add',
                'module_name' => 'Daily Petty Expense Management',
                'module_slug' => 'daily_petty_expense_management',
                'description' => 'Daily Petty Expense  Management',
                'status' => 1
            ],
             

           
             [
                'name' => 'Maintenance Reports View',
                'slug' => 'maintenance_reports_view',
                'module_name' => 'Maintenance Reports Management',
                'module_slug' => 'maintenance_reports_management',
                'description' => 'Maintenance Reports  Management',
                'status' => 1
            ],

            [
                'name' => 'Maintenance Reports Edit',
                'slug' => 'maintenance_reports_edit',
                'module_name' => 'Maintenance Reports Management',
                'module_slug' => 'maintenance_reports_management',
                'description' => 'Maintenance Reports  Management',
                'status' => 1
            ],


            [
                'name' => 'Maintenance Reports Add',
                'slug' => 'maintenance_reports_add',
                'module_name' => 'Maintenance Reports Management',
                'module_slug' => 'maintenance_reports_management',
                'description' => 'Maintenance Reports  Management',
                'status' => 1
            ],
            
            
             [
                'name' => 'Gift Card Reports View',
                'slug' => 'gift_card_reports_view',
                'module_name' => 'Gift Card Reports Management',
                'module_slug' => 'gift_card_reports_management',
                'description' => 'Gift Card Reports  Management',
                'status' => 1
            ],

            [
                'name' => 'Gift Card Reports Edit',
                'slug' => 'gift_card_reports_edit',
                'module_name' => 'Gift Card Reports Management',
                'module_slug' => 'gift_card_reports_management',
                'description' => 'Gift Card Reports  Management',
                'status' => 1
            ],

            [
                'name' => 'Gift Card Reports Add',
                'slug' => 'gift_card_reports_add',
                'module_name' => 'Gift Card Reports Management',
                'module_slug' => 'gift_card_reports_management',
                'description' => 'Gift Card Reports  Management',
                'status' => 1
            ],


            // [
            //     'name' => 'Branch Tip Reports View',
            //     'slug' => 'branch_tip_reports_view',
            //     'module_name' => 'Branch Tip Reports Management',
            //     'module_slug' => 'branch_tip_reports_management',
            //     'description' => 'Branch Tip Reports  Management',
            //     'status' => 1
            // ],

            // [
            //     'name' => ' Branch Tip Reports Edit',
            //     'slug' => 'branch_tip_reports_edit',
            //     'module_name' => 'Branch Tip Reports Management',
            //     'module_slug' => 'branch_tip_reports_management',
            //     'description' => 'Branch Tip Reports  Management',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Branch Tip Reports Add',
            //     'slug' => 'branch_tip_reports_add',
            //     'module_name' => 'Branch Tip Reports Management',
            //     'module_slug' => 'branch_tip_reports_management',
            //     'description' => 'Branch Tip Reports  Management',
            //     'status' => 1
            // ],


             [
                'name' => 'Tip Collection View',
                'slug' => 'branch_tip_collection_view',
                'module_name' => 'Branch Tip Collection Management',
                'module_slug' => 'branch_tip_collection_management',
                'description' => 'Branch Tip Collection  Management',
                'status' => 1
            ],

            [
                'name' => 'Tip Collection Edit',
                'slug' => 'branch_tip_reports_edit',
                'module_name' => 'Branch Tip Collection Management',
                'module_slug' => 'branch_tip_collection_management',
                'description' => 'Branch Tip Collection  Management',
                'status' => 1
            ],

            [
                'name' => 'Tip Collection Add',
                'slug' => 'branch_tip_reports_add',
                'module_name' => 'Branch Tip Collection Management',
                'module_slug' => 'branch_tip_collection_management',
                'description' => 'Branch Tip Collection  Management',
                'status' => 1
            ],


            [
                'name' => 'Tip Rider View',
                'slug' => 'branch_tip_rider_view',
                'module_name' => 'Branch Tip Rider Management',
                'module_slug' => 'branch_tip_rider_management',
                'description' => 'Branch Tip Rider  Management',
                'status' => 1
            ],

            [
                'name' => 'Tip Rider Edit',
                'slug' => 'branch_tip_rider_edit',
                'module_name' => 'Branch Tip Rider Management',
                'module_slug' => 'branch_tip_rider_management',
                'description' => 'Branch Tip Rider  Management',
                'status' => 1
            ],

            [
                'name' => 'Tip Rider Add',
                'slug' => 'branch_tip_rider_add',
                'module_name' => 'Branch Tip Rider Management',
                'module_slug' => 'branch_tip_rider_management',
                'description' => 'Branch Tip Rider  Management',
                'status' => 1
            ],

              [
                'name' => 'Sepcial Tip Distribution View',
                'slug' => 'branch_special_tip_distribution_view',
                'module_name' => 'Branch Sepcial Tip Distribution Management',
                'module_slug' => 'branch_special_tip_distribution_management',
                'description' => 'Branch Sepcial Tip Distribution  Management',
                'status' => 1
            ],

            [
                'name' => 'Sepcial Tip Distribution Edit',
                'slug' => 'branch_special_tip_distribution_edit',
                'module_name' => 'Branch Sepcial Tip Distribution Management',
                'module_slug' => 'branch_special_tip_distribution_management',
                'description' => 'Branch Sepcial Tip Distribution  Management',
                'status' => 1
            ],

            [
                'name' => 'Sepcial Tip Distribution Add',
                'slug' => 'branch_special_tip_distribution_add',
                'module_name' => 'Branch Sepcial Tip Distribution Management',
                'module_slug' => 'branch_special_tip_distribution_management',
                'description' => 'Branch Sepcial Tip Distribution  Management',
                'status' => 1
            ],


                    [
                'name' => 'Tip Distribution View',
                'slug' => 'branch_tip_distribution_view',
                'module_name' => 'Branch  Tip Distribution Management',
                'module_slug' => 'branch_tip_distribution_management',
                'description' => 'Branch  Tip Distribution  Management',
                'status' => 1
            ],

            [
                'name' => 'Tip Distribution Edit',
                'slug' => 'branch_tip_distribution_edit',
                'module_name' => 'Branch  Tip Distribution Management',
                'module_slug' => 'branch_tip_distribution_management',
                'description' => 'Branch  Tip Distribution  Management',
                'status' => 1
            ],

            [
                'name' => 'Tip Distribution Add',
                'slug' => 'branch_tip_distribution_add',
                'module_name' => 'Branch  Tip Distribution Management',
                'module_slug' => 'branch_tip_distribution_management',
                'description' => 'Branch  Tip Distribution  Management',
                'status' => 1
            ],



            // branch staff
            [
                'name' => 'Branch Staff View',
                'slug' => 'branch_staff_view',
                'module_name' => 'Branch Staff Management',
                'module_slug' => 'branch_Staff_management',
                'description' => 'Branch Staff Management',
                'status' => 1
            ],
            [
                'name' => 'Branch Staff Edit',
                'slug' => 'branch_staff_edit',
                'module_name' => 'Branch Staff Management',
                'module_slug' => 'branch_Staff_management',
                'description' => 'Branch Staff Management',
                'status' => 1
            ],

           
        ]);
        
    }
}
