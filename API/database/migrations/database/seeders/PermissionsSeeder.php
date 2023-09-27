<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run() {

   //  \DB::table('permission_role')->truncate();

       // \DB::table('permission_role')->where([
       //          'role_id' => 1
       //      ])->delete();

        \DB::table('permissions')->truncate();


        \DB::table('permissions')->insert([

            //Users Manegement [01 - Customer]
            [
                'name' => 'View',
                'slug' => 'view_customer',
                'module_name' => 'View',
                'module_slug' => 'manage_customer',
                'description' => 'Customers Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_customer',
                'module_name' => 'Edit',
                'module_slug' => 'manage_customer',
                'description' => 'Customers Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_customer',
                'module_name' => 'Delete',
                'module_slug' => 'manage_customer',
                'description' => 'Customers Management',
                'status' => 1
            ],
            // [
            //     'name' => 'Add',
            //     'slug' => 'add_customer',
            //     'module_name' => 'Add',
            //     'module_slug' => 'manage_customer',
            //     'description' => 'Customers Management',
            //     'status' => 1
            // ],


            //User Manegement [02 - Admin]
            [
                'name' => 'View',
                'slug' => 'view_admin',
                'module_name' => 'View',
                'module_slug' => 'manage_admin',
                'description' => 'Admins Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_admin',
                'module_name' => 'Edit',
                'module_slug' => 'manage_admin',
                'description' => 'Admins Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_admin',
                'module_name' => 'Delete',
                'module_slug' => 'manage_admin',
                'description' => 'Admins Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_admin',
                'module_name' => 'Add',
                'module_slug' => 'manage_admin',
                'description' => 'Admins Management',
                'status' => 1
            ],

            //User Management [03 -Branch Managers Manegement]

            [
                'name' => 'View',
                'slug' => 'view_branch_manager',
                'module_name' => 'View',
                'module_slug' => 'manage_branch_manager',
                'description' => 'Branch Manager Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_branch_manager',
                'module_name' => 'Edit',
                'module_slug' => 'manage_branch_manager',
                'description' => 'Branch Manager Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_branch_manager',
                'module_name' => 'Delete',
                'module_slug' => 'manage_branch_manager',
                'description' => 'Branch Manager Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_branch_manager',
                'module_name' => 'Add',
                'module_slug' => 'manage_branch_manager',
                'description' => 'Branch Manager Management',
                'status' => 1
            ],




            //User Management [04 - Staff Manegement]

            [
                'name' => 'View',
                'slug' => 'view_branch_staff',
                'module_name' => 'View',
                'module_slug' => 'manage_branch_staff',
                'description' => 'Branch Staff Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_branch_staff',
                'module_name' => 'Edit',
                'module_slug' => 'manage_branch_staff',
                'description' => 'Branch Staff Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_branch_staff',
                'module_name' => 'Delete',
                'module_slug' => 'manage_branch_staff',
                'description' => 'Branch Staff Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_branch_staff',
                'module_name' => 'Add',
                'module_slug' => 'manage_branch_staff',
                'description' => 'Branch Staff Management',
                'status' => 1
            ],

            //Managements

            [
                'name' => 'View',
                'slug' => 'view_management',
                'module_name' => 'View',
                'module_slug' => 'manage_management',
                'description' => 'Management Tab',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_management',
                'module_name' => 'Edit',
                'module_slug' => 'manage_management',
                'description' => 'Management Tab',
                'status' => 1
            ],


            //Branch Management

            [
                'name' => 'View',
                'slug' => 'view_branch',
                'module_name' => 'View',
                'module_slug' => 'manage_branch',
                'description' => 'Branches Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_branch',
                'module_name' => 'Edit',
                'module_slug' => 'manage_branch',
                'description' => 'Branches Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_branch',
                'module_name' => 'Delete',
                'module_slug' => 'manage_branch',
                'description' => 'Branches Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_branch',
                'module_name' => 'Add',
                'module_slug' => 'manage_branch',
                'description' => 'Branches Management',
                'status' => 1
            ],

            [
                'name' => 'Edit Staff',
                'slug' => 'add_staff',
                'module_name' => 'Add',
                'module_slug' => 'manage_branch',
                'description' => 'Branches Management',
                'status' => 1
            ],

            [
                'name' => 'Add Staff',
                'slug' => 'edit_staff',
                'module_name' => 'Add',
                'module_slug' => 'manage_branch',
                'description' => 'Branches Management',
                'status' => 1
            ],



             //Branch Locality

            [
                'name' => 'View',
                'slug' => 'view_branch_locality',
                'module_name' => 'View',
                'module_slug' => 'manage_branch_locality',
                'description' => 'Branche Locality Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_branch_locality',
                'module_name' => 'Edit',
                'module_slug' => 'manage_branch_locality',
                'description' => 'Branche Locality Management',
                'status' => 1
            ],

            [
                'name' => 'Add',
                'slug' => 'add_branch_locality',
                'module_name' => 'Add',
                'module_slug' => 'manage_branch_locality',
                'description' => 'Branche Locality Management',
                'status' => 1
            ],



            //Menu Management [01 - Category]


            [
                'name' => 'View',
                'slug' => 'view_category',
                'module_name' => 'View',
                'module_slug' => 'manage_menu_category',
                'description' => 'Categories Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_category',
                'module_name' => 'Edit',
                'module_slug' => 'manage_menu_category',
                'description' => 'Categories Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_category',
                'module_name' => 'Delete',
                'module_slug' => 'manage_menu_category',
                'description' => 'Categories Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_category',
                'module_name' => 'Add',
                'module_slug' => 'manage_menu_category',
                'description' => 'Categories Management',
                'status' => 1
            ],



            //Menu Management [02- Items Management]


            [
                'name' => 'View',
                'slug' => 'view_item',
                'module_name' => 'View',
                'module_slug' => 'manage_menu_item',
                'description' => 'Items Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_item',
                'module_name' => 'Edit',
                'module_slug' => 'manage_menu_item',
                'description' => 'Items Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_item',
                'module_name' => 'Delete',
                'module_slug' => 'manage_menu_item',
                'description' => 'Items Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_item',
                'module_name' => 'Add',
                'module_slug' => 'manage_menu_item',
                'description' => 'Items Management',
                'status' => 1
            ],


             //Item Availability

            [
                'name' => 'View',
                'slug' => 'view_item_availability',
                'module_name' => 'View',
                'module_slug' => 'manage_menu_item_availability',
                'description' => 'Items Availabality Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_item_availability',
                'module_name' => 'Edit',
                'module_slug' => 'manage_menu_item_availability',
                'description' => 'Items Availabality Management',
                'status' => 1
            ],


              //catering Management

            [
                'name' => 'View',
                'slug' => 'view_catering',
                'module_name' => 'View',
                'module_slug' => 'manage_catering',
                'description' => 'Catering Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_catering',
                'module_name' => 'Edit',
                'module_slug' => 'manage_catering',
                'description' => 'Catering Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_catering',
                'module_name' => 'Delete',
                'module_slug' => 'manage_catering',
                'description' => 'Catering Management',
                'status' => 1
            ],



             //Offers Management

                   //01 - checkout offer
            [
                'name' => 'View',
                'slug' => 'view_current_offer',
                'module_name' => 'View',
                'module_slug' => 'manage_current_offer',
                'description' => 'Current Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_current_offer',
                'module_name' => 'Edit',
                'module_slug' => 'manage_current_offer',
                'description' => 'Current Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_current_offer',
                'module_name' => 'Delete',
                'module_slug' => 'manage_current_offer',
                'description' => 'Current Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_current_offer',
                'module_name' => 'Add',
                'module_slug' => 'manage_current_offer',
                'description' => 'Current Offer Management',
                'status' => 1
            ],



                  //01 - checkout offer
            [
                'name' => 'View',
                'slug' => 'view_checkout_offer',
                'module_name' => 'View',
                'module_slug' => 'manage_checkout_offer',
                'description' => 'Checkout Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_checkout_offer',
                'module_name' => 'Edit',
                'module_slug' => 'manage_checkout_offer',
                'description' => 'Checkout Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_checkout_offer',
                'module_name' => 'Delete',
                'module_slug' => 'manage_checkout_offer',
                'description' => 'Checkout Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_checkout_offer',
                'module_name' => 'Add',
                'module_slug' => 'manage_checkout_offer',
                'description' => 'Checkout Offer Management',
                'status' => 1
            ],


                 //02 - disount offer
            [
                'name' => 'View',
                'slug' => 'view_discount_offer',
                'module_name' => 'View',
                'module_slug' => 'manage_discount_offer',
                'description' => 'Discount Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_discount_offer',
                'module_name' => 'Edit',
                'module_slug' => 'manage_discount_offer',
                'description' => 'Discount Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_discount_offer',
                'module_name' => 'Delete',
                'module_slug' => 'manage_discount_offer',
                'description' => 'Discount Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_discount_offer',
                'module_name' => 'Add',
                'module_slug' => 'manage_discount_offer',
                'description' => 'Discount Offer Management',
                'status' => 1
            ],


                 //03 - Coupon code offer
            [
                'name' => 'View',
                'slug' => 'view_coupon_offer',
                'module_name' => 'View',
                'module_slug' => 'manage_coupon_offer',
                'description' => 'Coupon Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_coupon_offer',
                'module_name' => 'Edit',
                'module_slug' => 'manage_coupon_offer',
                'description' => 'Coupon Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_coupon_offer',
                'module_name' => 'Delete',
                'module_slug' => 'manage_coupon_offer',
                'description' => 'Coupon Offer Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_coupon_offer',
                'module_name' => 'Add',
                'module_slug' => 'manage_coupon_offer',
                'description' => 'Coupon Offer Management',
                'status' => 1
            ],



              //04 - Gift Cards
            [
                'name' => 'View',
                'slug' => 'view_gift_card',
                'module_name' => 'View',
                'module_slug' => 'manage_gift_card',
                'description' => 'Gift Card Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_gift_card',
                'module_name' => 'Edit',
                'module_slug' => 'manage_gift_card',
                'description' => 'Gift Card Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_gift_card',
                'module_name' => 'Delete',
                'module_slug' => 'manage_gift_card',
                'description' => 'Gift Card Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_gift_card',
                'module_name' => 'Add',
                'module_slug' => 'manage_gift_card',
                'description' => 'Gift Card Management',
                'status' => 1
            ],






            //Loyalties Management

            [
                'name' => 'View',
                'slug' => 'view_loyalty',
                'module_name' => 'View',
                'module_slug' => 'manage_loyalty',
                'description' => 'Loyalties Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_loyalty',
                'module_name' => 'Edit',
                'module_slug' => 'manage_loyalty',
                'description' => 'Loyalties Management',
                'status' => 1
            ],
            // [
            //     'name' => 'Delete',
            //     'slug' => 'delete_loyalty',
            //     'module_name' => 'Delete',
            //     'module_slug' => 'manage_loyalty',
            //     'description' => 'Loyalties Management',
            //     'status' => 1
            // ],







            //Blogs Management

            [
                'name' => 'View',
                'slug' => 'view_blog',
                'module_name' => 'View',
                'module_slug' => 'manage_blog',
                'description' => 'Blogs Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_blog',
                'module_name' => 'Edit',
                'module_slug' => 'manage_blog',
                'description' => 'Blogs Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_blog',
                'module_name' => 'Delete',
                'module_slug' => 'manage_blog',
                'description' => 'Blogs Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_blog',
                'module_name' => 'Add',
                'module_slug' => 'manage_blog',
                'description' => 'Blogs Management',
                'status' => 1
            ],



                //Order Management

            [
                'name' => 'View',
                'slug' => 'view_order',
                'module_name' => 'View',
                'module_slug' => 'manage_order',
                'description' => 'Order Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_order',
                'module_name' => 'Edit',
                'module_slug' => 'manage_order',
                'description' => 'Order Management',
                'status' => 1
            ],

            //Payment Transaction

            [
                'name' => 'View',
                'slug' => 'view_payment_transaction',
                'module_name' => 'View',
                'module_slug' => 'payment_transaction',
                'description' => 'Payment Transaction',
                'status' => 1
            ],


              //Content Management [01 - website content]


            [
                'name' => 'View',
                'slug' => 'view_website_content',
                'module_name' => 'View',
                'module_slug' => 'manage_website_content',
                'description' => 'Website Content',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_website_content',
                'module_name' => 'Edit',
                'module_slug' => 'manage_website_content',
                'description' => 'Website Content',
                'status' => 1
            ],



          //Start reports

            // [
            //     'name' => 'View',
            //     'slug' => 'view_report',
            //     'module_name' => 'View',
            //     'module_slug' => 'manage_reports',
            //     'description' => 'Reports Management',
            //     'status' => 1
            // ],

            [
                'name' => 'View',
                'slug' => 'view_cash_deposite_branch_wise_report',
                'module_name' => 'View',
                'module_slug' => 'manage_cash_deposite_reports',
                'description' => 'Cash Deposite Branch Wise Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_cash_deposite_branch_wise_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_cash_deposite_reports',
                'description' => 'Cash Deposite Branch Wise Reports Management',
                'status' => 1
            ],


            [
                'name' => 'View',
                'slug' => 'view_daily_sales_report',
                'module_name' => 'View',
                'module_slug' => 'manage_daily_sales_reports',
                'description' => 'Daily Sales Report (DSR) Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Edit',
                'slug' => 'edit_daily_sales_report',
                'module_name' => 'Edit',
                'module_slug' => 'manage_daily_sales_reports',
                'description' => 'Daily Sales Report (DSR) Reports Management',
                'status' => 1
            ],



            [
                'name' => 'Download',
                'slug' => 'download_daily_sales_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_daily_sales_reports',
                'description' => 'Daily Sales Report (DSR) Reports Management',
                'status' => 1
            ],


            [
                'name' => 'Delete',
                'slug' => 'delete_daily_sales_report',
                'module_name' => 'Delete',
                'module_slug' => 'manage_daily_sales_reports',
                'description' => 'Daily Sales Report (DSR) Reports Management',
                'status' => 1
            ],




            [
                'name' => 'View',
                'slug' => 'view_payment_methods_branch_wise_report',
                'module_name' => 'View',
                'module_slug' => 'manage_payment_methods_branch_wise_reports',
                'description' => 'Payment Methods Branch Wise Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_payment_methods_branch_wise_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_payment_methods_branch_wise_reports',
                'description' => 'Payment Methods Branch Wise Reports Management',
                'status' => 1
            ],


            [
                'name' => 'View',
                'slug' => 'view_sales_by_branch_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_branch_reports',
                'description' => 'Sales by Branch Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_branch_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_branch_reports',
                'description' => 'Sales by Branch Reports Management',
                'status' => 1
            ],

            [
                'name' => 'View',
                'slug' => 'view_sales_by_branch_net_sale_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_branch_net_sale_reports',
                'description' => 'Sales by Branch Net Sale Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_branch_net_sale_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_branch_net_sale_reports',
                'description' => 'Sales by Branch Net Sale Reports Management',
                'status' => 1
            ],


            //MK

            [
                'name' => 'View',
                'slug' => 'view_sales_by_branch_gross_sale_monthly_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_branch_gross_sale_monthly_reports',
                'description' => 'Sales by Branch Gross Sale Monthly Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_branch_gross_sale_monthly_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_branch_gross_sale_monthly_reports',
                'description' => 'Sales by Branch Gross Sale Monthly Reports Management',
                'status' => 1
            ],


               [
                'name' => 'View',
                'slug' => 'view_sales_by_branch_net_sale_monthly_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_branch_net_sale_monthly_reports',
                'description' => 'Sales by Branch Net Sale Monthly Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_branch_net_sale_monthly_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_branch_net_sale_monthly_reports',
                'description' => 'Sales by Branch Net Sale Monthly Reports Management',
                'status' => 1
            ],


            //Mk

            [
                'name' => 'View',
                'slug' => 'view_sales_by_branch_discount_sale_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_branch_discount_sale_reports',
                'description' => 'Sales by Branch Discount Sale Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_branch_discount_sale_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_branch_discount_sale_reports',
                'description' => 'Sales by Branch Discount Sale Reports Management',
                'status' => 1
            ],


            // dis_com_return

             [
                'name' => 'View',
                'slug' => 'view_discount_complimentary_return_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_branch_dis_com_return_reports',
                'description' => 'Sales by Branch Discount Complimentary Return Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_discount_complimentary_return_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_branch_dis_com_return_reports',
                'description' => 'Sales by Branch Discount Complimentary Return Reports Management',
                'status' => 1
            ],





            [
                'name' => 'View',
                'slug' => 'view_sales_by_month_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_month_reports',
                'description' => 'Sales by Month Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_month_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_month_reports',
                'description' => 'Sales by Month Reports Management',
                'status' => 1
            ],


            [
                'name' => 'View',
                'slug' => 'view_sales_by_service_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_service_reports',
                'description' => 'Sales by Service Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_service_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_service_reports',
                'description' => 'Sales by Service Reports Management',
                'status' => 1
            ],


                [
                'name' => 'View',
                'slug' => 'view_sales_by_complimentary_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_by_complimentary_reports',
                'description' => 'Sales by Complimentary Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_by_complimentary_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_by_complimentary_reports',
                'description' => 'Sales by Complimentary Reports Management',
                'status' => 1
            ],




            [
                'name' => 'View',
                'slug' => 'view_branch_petty_cash_report',
                'module_name' => 'View',
                'module_slug' => 'manage_branch_petty_cash_reports',
                'description' => 'Branch Petty Cash Reports Management',
                'status' => 1
            ],

            // [
            //     'name' => 'Edit',
            //     'slug' => 'edit_branch_petty_cash_report',
            //     'module_name' => 'Edit',
            //     'module_slug' => 'manage_branch_petty_cash_reports',
            //     'description' => 'Branch Petty Cash Reports Management',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Delete',
            //     'slug' => 'delete_branch_petty_cash_report',
            //     'module_name' => 'Delete',
            //     'module_slug' => 'manage_branch_petty_cash_reports',
            //     'description' => 'Branch Petty Cash Reports Management',
            //     'status' => 1
            // ],


            [
                'name' => 'Download',
                'slug' => 'download_branch_petty_cash_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_branch_petty_cash_reports',
                'description' => 'Branch Petty Cash Reports Management',
                'status' => 1
            ],


            [
                'name' => 'View',
                'slug' => 'view_petty_cash_by_branch_report',
                'module_name' => 'View',
                'module_slug' => 'manage_petty_cash_by_branch_reports',
                'description' => ' Petty cash By Branch (Month Wise) Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_petty_cash_by_branch_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_petty_cash_by_branch_reports',
                'description' => 'Petty cash By Branch (Month Wise) Reports Management',
                'status' => 1
            ],


            [
                'name' => 'View',
                'slug' => 'view_petty_cash_by_month_report',
                'module_name' => 'View',
                'module_slug' => 'manage_petty_cash_by_month_reports',
                'description' => ' Petty cash By Month (Month Wise) Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_petty_cash_by_month_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_petty_cash_by_month_reports',
                'description' => 'Petty cash By Month (Single Branch) Reports Management',
                'status' => 1
            ],



            [
                'name' => 'View',
                'slug' => 'view_car_wise_fule_report_report',
                'module_name' => 'View',
                'module_slug' => 'manage_car_wise_fule_report_reports',
                'description' => 'Car Wise Fule Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_car_wise_fule_report_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_car_wise_fule_report_reports',
                'description' => 'Car Wise Fule Reports Management',
                'status' => 1
            ],




              [
                'name' => 'View',
                'slug' => 'view_sales_petty_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_petty_reports',
                'description' => ' Sales & Petty Reporting Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Edit',
                'slug' => 'edit_sales_petty_report',
                'module_name' => 'Edit',
                'module_slug' => 'manage_sales_petty_reports',
                'description' => ' Sales & Petty Reporting Reports Management',
                'status' => 1
            ],


            [
                'name' => 'Download',
                'slug' => 'download_sales_petty_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_petty_reports',
                'description' => 'Sales & Petty Reporting Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Delete',
                'slug' => 'delete_sales_petty_report',
                'module_name' => 'Delete',
                'module_slug' => 'manage_sales_petty_reports',
                'description' => 'Sales & Petty Reporting Reports Management',
                'status' => 1
            ],




            // [
            //     'name' => 'Add Received Amount',
            //     'slug' => 'add_received_amount_sales_petty_report',
            //     'module_name' => 'Add Received Amount',
            //     'module_slug' => 'manage_sales_petty_reports',
            //     'description' => 'Sales & Petty Reporting Reports Management',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Edit  Received Amount',
            //     'slug' => 'edit_received_amount_sales_petty_report',
            //     'module_name' => 'Add Received Amount',
            //     'module_slug' => 'manage_sales_petty_reports',
            //     'description' => 'Sales & Petty Reporting Reports Management',
            //     'status' => 1
            // ],





            [
                'name' => 'View',
                'slug' => 'view_credit_card_report',
                'module_name' => 'View',
                'module_slug' => 'manage_credit_card_reports',
                'description' => 'Credit Card Reporting Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_credit_card_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_credit_card_reports',
                'description' => 'Credit Card Reporting Reports Management',
                'status' => 1
            ],


            [
                'name' => 'View',
                'slug' => 'view_sales_report',
                'module_name' => 'View',
                'module_slug' => 'manage_sales_reports',
                'description' => 'Sales Reporting Reports Management',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_sales_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_sales_reports',
                'description' => 'Sales Reporting Reports Management',
                'status' => 1
            ],



            [
                'name' => 'View',
                'slug' => 'view_credit_card_report_by_month_report',
                'module_name' => 'View',
                'module_slug' => 'manage_credit_card_report_by_month_reports',
                'description' => 'Credit Card Report By Month',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_credit_card_report_by_month_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_credit_card_report_by_month_reports',
                'description' => 'Credit Card Report By Month',
                'status' => 1
            ],


            //---Maintenance Reports

            [
                'name' => 'View',
                'slug' => 'view_maintenance_report',
                'module_name' => 'View',
                'module_slug' => 'manage_maintenance_reports',
                'description' => 'Maintenance Reporting',
                'status' => 1
            ],

            [
                'name' => 'Edit',
                'slug' => 'edit_maintenance_report',
                'module_name' => 'Edit',
                'module_slug' => 'manage_maintenance_reports',
                'description' => 'Maintenance Reporting',
                'status' => 1
            ],

            [
                'name' => 'Delete',
                'slug' => 'delete_maintenance_report',
                'module_name' => 'Delete',
                'module_slug' => 'manage_maintenance_reports',
                'description' => 'Maintenance Reporting',
                'status' => 1
            ],


            [
                'name' => 'Download',
                'slug' => 'download_maintenance_report',
                'module_name' => 'View',
                'module_slug' => 'manage_maintenance_reports',
                'description' => 'Maintenance Reporting',
                'status' => 1
            ],



            //---Maintenance Reports



                   //---Tip Reports

            [
                'name' => 'View',
                'slug' => 'view_tip_report',
                'module_name' => 'View',
                'module_slug' => 'manage_tip_reports',
                'description' => 'Tip Reporting',
                'status' => 1
            ],

            [
                'name' => 'Edit',
                'slug' => 'edit_tip_report',
                'module_name' => 'Edit',
                'module_slug' => 'manage_tip_reports',
                'description' => 'Tip Reporting',
                'status' => 1
            ],

            [
                'name' => 'Delete',
                'slug' => 'delete_tip_report',
                'module_name' => 'Delete',
                'module_slug' => 'manage_tip_reports',
                'description' => 'Tip Reporting',
                'status' => 1
            ],





            //---Tip Reports



            [
                'name' => 'View',
                'slug' => 'view_gift_card_report',
                'module_name' => 'View',
                'module_slug' => 'manage_gift_card_reports',
                'description' => 'Gift Cards Reporting',
                'status' => 1
            ],

             [
                'name' => 'Edit',
                'slug' => 'edit_gift_card_report',
                'module_name' => 'Edit',
                'module_slug' => 'manage_gift_card_reports',
                'description' => 'Gift Cards Reporting',
                'status' => 1
            ],

            [
                'name' => 'Delete',
                'slug' => 'delete_gift_card_report',
                'module_name' => 'Delete',
                'module_slug' => 'manage_gift_card_reports',
                'description' => 'Gift Cards Reporting',
                'status' => 1
            ],


             [
                'name' => 'Download',
                'slug' => 'download_gift_card_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_gift_card_reports',
                'description' => 'Gift Cards Reporting',
                'status' => 1
            ],


             [
                'name' => 'View',
                'slug' => 'view_gift_cards_all_branch_report',
                'module_name' => 'View',
                'module_slug' => 'manage_gift_cards_all_branch_reports',
                'description' => 'Gift Cards All Branch Reporting',
                'status' => 1
            ],

            [
                'name' => 'Download',
                'slug' => 'download_gift_cards_all_branch_report',
                'module_name' => 'Download',
                'module_slug' => 'manage_gift_cards_all_branch_reports',
                'description' => 'Gift Cards All Branch Reporting',
                'status' => 1
            ],



        //End reports

              //Content Management [02 - banner management]

            [
                'name' => 'View',
                'slug' => 'view_banner',
                'module_name' => 'View',
                'module_slug' => 'manage_banner',
                'description' => 'Banners Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_banner',
                'module_name' => 'Edit',
                'module_slug' => 'manage_banner',
                'description' => 'Banners Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_banner',
                'module_name' => 'Delete',
                'module_slug' => 'manage_banner',
                'description' => 'Banners Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_banner',
                'module_name' => 'Add',
                'module_slug' => 'manage_banner',
                'description' => 'Banners Management',
                'status' => 1
            ],


           //Media Management

              [
                'name' => 'View',
                'slug' => 'view_media',
                'module_name' => 'View',
                'module_slug' => 'manage_media',
                'description' => 'Medias Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_media',
                'module_name' => 'Edit',
                'module_slug' => 'manage_media',
                'description' => 'Medias Management',
                'status' => 1
            ],



           //Theme Management

              [
                'name' => 'View',
                'slug' => 'view_theme',
                'module_name' => 'View',
                'module_slug' => 'manage_theme',
                'description' => 'Themes Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_theme',
                'module_name' => 'Edit',
                'module_slug' => 'manage_theme',
                'description' => 'Themes Management',
                'status' => 1
            ],





              //Content Management [02 - Social Links management]

            [
                'name' => 'View',
                'slug' => 'view_social_link',
                'module_name' => 'View',
                'module_slug' => 'manage_social_link',
                'description' => 'Social Links Management',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_social_link',
                'module_name' => 'Edit',
                'module_slug' => 'manage_social_link',
                'description' => 'Social Links Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_social_link',
                'module_name' => 'Delete',
                'module_slug' => 'manage_social_link',
                'description' => 'Social Links Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_social_link',
                'module_name' => 'Add',
                'module_slug' => 'manage_social_link',
                'description' => 'Social Links Management',
                'status' => 1
            ],




            // Contact Us management
            [
                'name' => 'View',
                'slug' => 'view_contact_us',
                'module_name' => 'View',
                'module_slug' => 'manage_contact_us',
                'description' => 'Manage Contact Us',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_contact_us',
                'module_name' => 'Edit',
                'module_slug' => 'manage_contact_us',
                'description' => 'Manage Contact Us',
                'status' => 1
            ],
            [
                'name' => 'Reply',
                'slug' => 'reply_contact_us',
                'module_name' => 'Reply',
                'module_slug' => 'manage_contact_us',
                'description' => 'Manage Contact Us',
                'status' => 1
            ],




               //User's Feedback [Join us Requests Management]

            [
                'name' => 'View',
                'slug' => 'view_joinus',
                'module_name' => 'View',
                'module_slug' => 'manage_joinus',
                'description' => 'Join Us  Management',
                'status' => 1
            ],

            [
                'name' => 'Reply',
                'slug' => 'reply_joinus',
                'module_name' => 'Reply',
                'module_slug' => 'manage_joinus',
                'description' => 'Join Us  Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_joinus',
                'module_name' => 'Edit',
                'module_slug' => 'manage_joinus',
                'description' => 'Join Us Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_joinus',
                'module_name' => 'Delete',
                'module_slug' => 'manage_joinus',
                'description' => 'Join Us Management',
                'status' => 1
            ],



                //User's Feedback [Review Management]

            [
                'name' => 'View',
                'slug' => 'view_review',
                'module_name' => 'View',
                'module_slug' => 'manage_review',
                'description' => 'Reviews Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_review',
                'module_name' => 'Edit',
                'module_slug' => 'manage_review',
                'description' => 'Reviews Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_review',
                'module_name' => 'Delete',
                'module_slug' => 'manage_review',
                'description' => 'Reviews Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_review',
                'module_name' => 'Add',
                'module_slug' => 'manage_review',
                'description' => 'Reviews Management',
                'status' => 1
            ],



              //Misc Data Management [Brands Management]

            [
                'name' => 'View',
                'slug' => 'view_brand',
                'module_name' => 'View',
                'module_slug' => 'manage_brand',
                'description' => 'Brands Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_brand',
                'module_name' => 'Edit',
                'module_slug' => 'manage_brand',
                'description' => 'Brands Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_brand',
                'module_name' => 'Delete',
                'module_slug' => 'manage_brand',
                'description' => 'Brands Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_brand',
                'module_name' => 'Add',
                'module_slug' => 'manage_brand',
                'description' => 'Brands Management',
                'status' => 1
            ],




              //Misc Data Management [Subsidiaries Management]

            [
                'name' => 'View',
                'slug' => 'view_subsidiaries',
                'module_name' => 'View',
                'module_slug' => 'manage_subsidiaries',
                'description' => 'Subsidiaries Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_subsidiaries',
                'module_name' => 'Edit',
                'module_slug' => 'manage_subsidiaries',
                'description' => 'Subsidiaries Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_subsidiaries',
                'module_name' => 'Delete',
                'module_slug' => 'manage_subsidiaries',
                'description' => 'Subsidiaries Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_subsidiaries',
                'module_name' => 'Add',
                'module_slug' => 'manage_subsidiaries',
                'description' => 'Subsidiaries Management',
                'status' => 1
            ],




                 //Misc Data Management [Blocks Management]

            [
                'name' => 'View',
                'slug' => 'view_blocks',
                'module_name' => 'View',
                'module_slug' => 'manage_blocks',
                'description' => 'Blocks Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_blocks',
                'module_name' => 'Edit',
                'module_slug' => 'manage_blocks',
                'description' => 'Blocks Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_blocks',
                'module_name' => 'Delete',
                'module_slug' => 'manage_blocks',
                'description' => 'Blocks Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_blocks',
                'module_name' => 'Add',
                'module_slug' => 'manage_blocks',
                'description' => 'Blocks Management',
                'status' => 1
            ],



              //Misc Data Management [City Management]

            [
                'name' => 'View',
                'slug' => 'view_city',
                'module_name' => 'View',
                'module_slug' => 'manage_city',
                'description' => 'Cities Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_city',
                'module_name' => 'Edit',
                'module_slug' => 'manage_city',
                'description' => 'Cities Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_city',
                'module_name' => 'Delete',
                'module_slug' => 'manage_city',
                'description' => 'Cities Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_city',
                'module_name' => 'Add',
                'module_slug' => 'manage_city',
                'description' => 'Cities Management',
                'status' => 1
            ],


             //Misc Data Management [Security Management]

            [
                'name' => 'View',
                'slug' => 'view_question',
                'module_name' => 'View',
                'module_slug' => 'manage_question',
                'description' => 'Security Questions Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_question',
                'module_name' => 'Edit',
                'module_slug' => 'manage_question',
                'description' => 'Security Questions Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_question',
                'module_name' => 'Delete',
                'module_slug' => 'manage_question',
                'description' => 'Security Questions Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_question',
                'module_name' => 'Add',
                'module_slug' => 'manage_question',
                'description' => 'Security Questions Management',
                'status' => 1
            ],



             //Misc Data Management [Designations Management]

            [
                'name' => 'View',
                'slug' => 'view_designations',
                'module_name' => 'View',
                'module_slug' => 'manage_designations',
                'description' => 'Designations Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_designations',
                'module_name' => 'Edit',
                'module_slug' => 'manage_designations',
                'description' => 'Designations Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_designations',
                'module_name' => 'Delete',
                'module_slug' => 'manage_designations',
                'description' => 'Designations Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_designations',
                'module_name' => 'Add',
                'module_slug' => 'manage_designations',
                'description' => 'Designations Management',
                'status' => 1
            ],



                //Petty Expense category
            [
                'name' => 'View',
                'slug' => 'view_petty_exp_category',
                'module_name' => 'View',
                'module_slug' => 'manage_petty_exp_category',
                'description' => 'Petty Expense Category Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_petty_exp_category',
                'module_name' => 'Edit',
                'module_slug' => 'manage_petty_exp_category',
                'description' => 'Petty Expense Category Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_petty_exp_category',
                'module_name' => 'Delete',
                'module_slug' => 'manage_petty_exp_category',
                'description' => 'Petty Expense Category Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_petty_exp_category',
                'module_name' => 'Add',
                'module_slug' => 'manage_petty_exp_category',
                'description' => 'Petty Expense Category Management',
                'status' => 1
            ],


                     //Petty Expense Sub category
            [
                'name' => 'View',
                'slug' => 'view_petty_exp_sub_category',
                'module_name' => 'View',
                'module_slug' => 'manage_petty_exp_sub_category',
                'description' => 'Petty Expense Sub Category  Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_petty_exp_sub_category',
                'module_name' => 'Edit',
                'module_slug' => 'manage_petty_exp_sub_category',
                'description' => 'Petty Expense Sub Category Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_petty_exp_sub_category',
                'module_name' => 'Delete',
                'module_slug' => 'manage_petty_exp_sub_category',
                'description' => 'Petty Expense Sub Category Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_petty_exp_sub_category',
                'module_name' => 'Add',
                'module_slug' => 'manage_petty_exp_sub_category',
                'description' => 'Petty Expense Sub Category Management',
                'status' => 1
            ],

            // Start Misc Maintenance

                   // Maintenance  Category
            [
                'name' => 'View',
                'slug' => 'view_maintenance_category',
                'module_name' => 'View',
                'module_slug' => 'manage_maintenance_category',
                'description' => 'Maintenance Category Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_maintenance_category',
                'module_name' => 'Edit',
                'module_slug' => 'manage_maintenance_category',
                'description' => 'Maintenance Category Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_maintenance_category',
                'module_name' => 'Delete',
                'module_slug' => 'manage_maintenance_category',
                'description' => 'Maintenance Category Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_maintenance_category',
                'module_name' => 'Add',
                'module_slug' => 'manage_maintenance_category',
                'description' => 'Maintenance Category Management',
                'status' => 1
            ],


                   // Maintenance  Sub Category
            [
                'name' => 'View',
                'slug' => 'view_maintenance_sub_category',
                'module_name' => 'View',
                'module_slug' => 'manage_maintenance_sub_category',
                'description' => 'Maintenance Sub Category Management',
                'status' => 1
            ],


            [
                'name' => 'Edit',
                'slug' => 'edit_maintenance_sub_category',
                'module_name' => 'Edit',
                'module_slug' => 'manage_maintenance_sub_category',
                'description' => 'Maintenance Sub  Category Management',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_maintenance_sub_category',
                'module_name' => 'Delete',
                'module_slug' => 'manage_maintenance_sub_category',
                'description' => 'Maintenance Sub  Category Management',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_maintenance_sub_category',
                'module_name' => 'Add',
                'module_slug' => 'manage_maintenance_sub_category',
                'description' => 'Maintenance Sub Category Management',
                'status' => 1
            ],


            // Ownership

            [
                'name' => 'View',
                'slug' => 'view_ownership',
                'module_name' => 'View Ownership',
                'module_slug' => 'manage_ownership',
                'description' => 'Vehicle Ownership',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_ownership',
                'module_name' => 'Edit Ownership',
                'module_slug' => 'manage_ownership',
                'description' => 'Vehicle Ownership',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_ownership',
                'module_name' => 'Delete Ownership',
                'module_slug' => 'manage_ownership',
                'description' => 'Vehicle Ownership',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_ownership',
                'module_name' => 'Add Ownership',
                'module_slug' => 'manage_ownership',
                'description' => 'Vehicle Ownership',
                'status' => 1
            ],



              // Drivers

            [
                'name' => 'View',
                'slug' => 'view_driver',
                'module_name' => 'View Drivers',
                'module_slug' => 'manage_driver',
                'description' => 'Vehicle Drivers',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_driver',
                'module_name' => 'Edit Drivers',
                'module_slug' => 'manage_driver',
                'description' => 'Vehicle Drivers',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_driver',
                'module_name' => 'Delete Drivers',
                'module_slug' => 'manage_driver',
                'description' => 'Vehicle Drivers',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_driver',
                'module_name' => 'Add Drivers',
                'module_slug' => 'manage_driver',
                'description' => 'Vehicle Drivers',
                'status' => 1
            ],


               // Cars

            [
                'name' => 'View',
                'slug' => 'view_car',
                'module_name' => 'View Cars',
                'module_slug' => 'manage_car',
                'description' => 'Vehicle Cars',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_car',
                'module_name' => 'Edit Cars',
                'module_slug' => 'manage_car',
                'description' => 'Vehicle Cars',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_car',
                'module_name' => 'Delete Cars',
                'module_slug' => 'manage_car',
                'description' => 'Vehicle Cars',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_car',
                'module_name' => 'Add Cars',
                'module_slug' => 'manage_car',
                'description' => 'Vehicle Cars',
                'status' => 1
            ],





            //End Misc Maintenance

            //Roles
            [
                'name' => 'View',
                'slug' => 'view_role',
                'module_name' => 'View Role',
                'module_slug' => 'manage_roles',
                'description' => 'Roles',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_role',
                'module_name' => 'Edit Role',
                'module_slug' => 'manage_roles',
                'description' => 'Roles',
                'status' => 1
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_role',
                'module_name' => 'Delete Role',
                'module_slug' => 'manage_roles',
                'description' => 'Roles',
                'status' => 1
            ],
            [
                'name' => 'Add',
                'slug' => 'add_role',
                'module_name' => 'Add Role',
                'module_slug' => 'manage_roles',
                'description' => 'Roles',
                'status' => 1
            ],


//Permissions
            [
                'name' => 'View',
                'slug' => 'view_permission',
                'module_name' => 'View Permission',
                'module_slug' => 'manage_permission',
                'description' => 'Permissions',
                'status' => 1
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_permission',
                'module_name' => 'Edit Permission',
                'module_slug' => 'manage_permission',
                'description' => 'Permissions',
                'status' => 1
            ],




            //Recyclebin

            [
                'name' => 'View Deleted Customer',
                'slug' => 'view_deleted_customer',
                'module_name' => 'View Deleted Customer',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Customers',
                'status' => 1
            ],
            [
                'name' => 'Restore Customer',
                'slug' => 'restore_customer',
                'module_name' => 'Restore Customer',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Customers',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Customer',
                'slug' => 'permanent_deleted_customer',
                'module_name' => 'Permanent Delete Customer',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Customers',
                'status' => 1
            ],
            [
                'name' => 'View Deleted Admin',
                'slug' => 'view_deleted_admin',
                'module_name' => 'View Deleted Admin',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Admins',
                'status' => 1
            ],
            [
                'name' => 'Restore Admin',
                'slug' => 'restore_admin',
                'module_name' => 'Restore Admin',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Admins',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Admin',
                'slug' => 'permanent_deleted_admin',
                'module_name' => 'Permanent Delete Admin',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Admin',
                'status' => 1
            ],

             [
                'name' => 'View Deleted Staff',
                'slug' => 'view_deleted_staff',
                'module_name' => 'View Deleted Staff',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Staffs',
                'status' => 1
            ],
            [
                'name' => 'Restore Staff',
                'slug' => 'restore_staff',
                'module_name' => 'Restore Staff',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Staffs',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Staff',
                'slug' => 'permanent_deleted_staff',
                'module_name' => 'Permanent Delete Staffs',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Staff',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Branch Manager',
                'slug' => 'view_deleted_branch_manager',
                'module_name' => 'View Deleted Branch Manager',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Branch Manager',
                'status' => 1
            ],
            [
                'name' => 'Restore Branch Manager',
                'slug' => 'restore_branch_manager',
                'module_name' => 'Restore Branch Manager',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Branch Manager',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Branch Manager',
                'slug' => 'permanent_deleted_branch_manager',
                'module_name' => 'Permanent Delete Branch Manager',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Branch Manager',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Branch',
                'slug' => 'view_deleted_branch',
                'module_name' => 'View Deleted Branch',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Branches',
                'status' => 1
            ],
            [
                'name' => 'Restore Branch',
                'slug' => 'restore_branch',
                'module_name' => 'Restore Branch',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Branches',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Branch',
                'slug' => 'permanent_deleted_branch',
                'module_name' => 'Permanent Delete Branch',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Branches',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Menu Categories',
                'slug' => 'view_deleted_menu_categories',
                'module_name' => 'View Deleted Menu Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Menu Categories',
                'status' => 1
            ],
            [
                'name' => 'Restore Menu Categories',
                'slug' => 'restore_menu_categories',
                'module_name' => 'Restore Menu Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Menu Categories',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Menu Categories',
                'slug' => 'permanent_deleted_menu_categories',
                'module_name' => 'Permanent Delete Menu Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Menu Categories',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Menu Item',
                'slug' => 'view_deleted_menu_item',
                'module_name' => 'View Deleted Menu Item',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Menu Item',
                'status' => 1
            ],
            [
                'name' => 'Restore Menu Item',
                'slug' => 'restore_menu_item',
                'module_name' => 'Restore Menu Item',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Menu Item',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Menu Item',
                'slug' => 'permanent_deleted_menu_item',
                'module_name' => 'Permanent Delete Menu Item',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Menu Item',
                'status' => 1
            ],


             [
                'name' => 'View Deleted Blog',
                'slug' => 'view_deleted_blog',
                'module_name' => 'View Deleted Blog',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Blogs',
                'status' => 1
            ],
            [
                'name' => 'Restore Blog',
                'slug' => 'restore_blog',
                'module_name' => 'Restore Blog',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Blogs',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Blog',
                'slug' => 'permanent_deleted_blog',
                'module_name' => 'Permanent Delete Blog',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Blogs',
                'status' => 1
            ],

               //Offers Management



            [
                'name' => 'View Deleted Current Offer',
                'slug' => 'view_deleted_current_offer',
                'module_name' => 'View Deleted  Current Offer',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Current Offers',
                'status' => 1
            ],
            [
                'name' => 'Restore Current Offer',
                'slug' => 'restore_current_offer',
                'module_name' => 'Restore Current Offer',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Current Offers',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Current Offer',
                'slug' => 'permanent_deleted_current_offer',
                'module_name' => 'Permanent Delete Current Offer',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Current Offers',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Checkout Offer',
                'slug' => 'view_deleted_checkout_offer',
                'module_name' => 'View Deleted  Checkout Offer',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Checkout Offers',
                'status' => 1
            ],
            [
                'name' => 'Restore Checkout Offer',
                'slug' => 'restore_checkout_offer',
                'module_name' => 'Restore Checkout Offer',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Checkout Offers',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Checkout Offer',
                'slug' => 'permanent_deleted_checkout_offer',
                'module_name' => 'Permanent Delete  Checkout Offer',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Checkout Offers',
                'status' => 1
            ],

            [
                'name' => 'View Deleted Discount Offer',
                'slug' => 'view_deleted_discount_offer',
                'module_name' => 'View Deleted  Discount  ',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Discount Offers',
                'status' => 1
            ],
            [
                'name' => 'Restore Discount Offer',
                'slug' => 'restore_discount_offer',
                'module_name' => 'Restore Discount ',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Discount Offers',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Discount Offer',
                'slug' => 'permanent_deleted_discount_offer',
                'module_name' => 'Permanent Delete  Discount ',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Discount Offers',
                'status' => 1
            ],

            [
                'name' => 'View Deleted Coupon Code',
                'slug' => 'view_deleted_coupon_code',
                'module_name' => 'View Deleted  Coupon Code',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Coupon Code',
                'status' => 1
            ],
            [
                'name' => 'Restore Coupon Code',
                'slug' => 'restore_coupon_code',
                'module_name' => 'Restore Coupon Code',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Coupon Code',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Coupon Code',
                'slug' => 'permanent_deleted_coupon_code',
                'module_name' => 'Permanent Delete Coupon Code',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Coupon Code',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Gift Cards',
                'slug' => 'view_deleted_gift_cards',
                'module_name' => 'View Deleted Gift Cards',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Gift Cards',
                'status' => 1
            ],
            [
                'name' => 'Restore Gift Cards',
                'slug' => 'restore_gift_cards',
                'module_name' => 'Restore Deleted Gift Cards',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Gift Cards',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Gift Cards',
                'slug' => 'permanent_deleted_gift_cards',
                'module_name' => 'Permanent Delete  Gift Cards',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Gift Cards',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Daily Sales Report (DSR)',
                'slug' => 'view_deleted_dsr',
                'module_name' => 'View Deleted DSR',
                'module_slug' => 'recycle_bin',
                'description' => 'View Delete DSR',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Daily Sales Report (DSR)',
                'slug' => 'restore_dsr',
                'module_name' => 'Restore DSR',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore DSR',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Daily Sales Report (DSR)',
                'slug' => 'permanent_deleted_dsr',
                'module_name' => 'Permanent Delete DSR',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete DSR',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Sales & Petty Report',
                'slug' => 'view_deleted_sales_and_petty',
                'module_name' => 'View Deleted Sales & Petty Report',
                'module_slug' => 'recycle_bin',
                'description' => 'View Delete Sales & Petty Report',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Sales & Petty Report',
                'slug' => 'restore_sales_and_petty',
                'module_name' => 'Restore Sales & Petty Report',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Sales & Petty Report',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Sales & Petty Report',
                'slug' => 'permanent_deleted_sales_and_petty',
                'module_name' => 'Permanent Delete Sales & Petty Report',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete Sales & Petty Report',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Maintenance Report',
                'slug' => 'view_deleted_maintenance_report',
                'module_name' => 'View Deleted Maintenance Report',
                'module_slug' => 'recycle_bin',
                'description' => 'View Deleted Maintenance Report',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Maintenance Report',
                'slug' => 'restore_maintenance_report',
                'module_name' => 'Restore Maintenance Report',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Maintenance Report',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Maintenance Report',
                'slug' => 'permanent_delete_maintenance_report',
                'module_name' => 'Permanent Delete Maintenance  Report',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete Maintenance Report',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Tip Report',
                'slug' => 'view_deleted_tip_report',
                'module_name' => 'View Deleted Tip Report',
                'module_slug' => 'recycle_bin',
                'description' => 'View Deleted Tip Report',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Tip Report',
                'slug' => 'restore_tip_report',
                'module_name' => 'Restore Tip Report',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Tip Report',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Tip Report',
                'slug' => 'permanent_delete_tip_report',
                'module_name' => 'Permanent Delete Tip  Report',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete Tip Report',
                'status' => 1
            ],




            [
                'name' => 'View Deleted Brands',
                'slug' => 'view_deleted_brands',
                'module_name' => 'View Deleted Brands',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Brands',
                'status' => 1
            ],
            [
                'name' => 'Restore Brands',
                'slug' => 'restore_brands',
                'module_name' => 'Restore Brands',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Brands',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Brands',
                'slug' => 'permanent_deleted_brands',
                'module_name' => 'Permanent Delete Brands',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Brands',
                'status' => 1
            ],


             [
                'name' => 'View Deleted Blocks',
                'slug' => 'view_deleted_blocks',
                'module_name' => 'View Deleted Blocks',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Blocks',
                'status' => 1
            ],
            [
                'name' => 'Restore Blocks',
                'slug' => 'restore_blocks',
                'module_name' => 'Restore Blocks',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Blocks',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Blocks',
                'slug' => 'permanent_deleted_blocks',
                'module_name' => 'Permanent Delete Blocks',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Blocks',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Cities',
                'slug' => 'view_deleted_cities',
                'module_name' => 'View Deleted Cities',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Cities',
                'status' => 1
            ],
            [
                'name' => 'Restore Cities',
                'slug' => 'restore_cities',
                'module_name' => 'Restore Cities',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Cities',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Cities',
                'slug' => 'permanent_deleted_cities',
                'module_name' => 'Permanent Delete Cities',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Cities',
                'status' => 1
            ],

            [
                'name' => 'View Deleted Security Questions',
                'slug' => 'view_deleted_question',
                'module_name' => 'View Deleted Security Questions',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Security Questions',
                'status' => 1
            ],

            [
                'name' => 'Restore Security Questions',
                'slug' => 'restore_question',
                'module_name' => 'Restore Security Questions',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Security Questions',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Security Questions',
                'slug' => 'permanent_deleted_question',
                'module_name' => 'Permanent Delete Security Questions',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Security Questions',
                'status' => 1
            ],


            //------------

            [
                'name' => 'View Deleted  Designations',
                'slug' => 'view_deleted_designations',
                'module_name' => 'View Deleted  Designations',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Designations',
                'status' => 1
            ],

            [
                'name' => 'Restore  Designations',
                'slug' => 'restore_designations',
                'module_name' => 'Restore  Designations',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Designations',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete  Designations',
                'slug' => 'permanent_deleted_designations',
                'module_name' => 'Permanent Delete  Designations',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Designations',
                'status' => 1
            ],


            [
                'name' => 'View Deleted  Petty Expense Category',
                'slug' => 'view_deleted_petty_expense_category',
                'module_name' => 'View Deleted  Petty Expense Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Petty Expense Category',
                'status' => 1
            ],

            [
                'name' => 'Restore  Petty Expense Category',
                'slug' => 'restore_petty_expense_category',
                'module_name' => 'Restore  Petty Expense Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Petty Expense Category',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete  Petty Expense Category',
                'slug' => 'permanent_deleted_petty_expense_category',
                'module_name' => 'Permanent Delete  Petty Expense Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Petty Expense Category',
                'status' => 1
            ],


            [
                'name' => 'View Deleted  Petty Expense Sub Category',
                'slug' => 'view_deleted_petty_expense_sub_category',
                'module_name' => 'View Deleted  Petty Expense Sub Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Petty Expense Sub Category',
                'status' => 1
            ],

            [
                'name' => 'Restore  Petty Expense Sub Category',
                'slug' => 'restore_petty_expense_sub_category',
                'module_name' => 'Restore  Petty Expense Sub Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Petty Expense Sub Category',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete  Petty Expense Sub Category',
                'slug' => 'permanent_deleted_petty_expense_sub_category',
                'module_name' => 'Permanent Delete  Petty Expense Sub Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Petty Expense Sub Category',
                'status' => 1
            ],




            [
                'name' => 'View Deleted  Maintenance Category',
                'slug' => 'view_deleted_maintenance_category',
                'module_name' => 'View Deleted  Maintenance Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Maintenance Category',
                'status' => 1
            ],

            [
                'name' => 'Restore  Maintenance Category',
                'slug' => 'restore_maintenance_category',
                'module_name' => 'Restore  Maintenance Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Maintenance Category',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete  Maintenance Category',
                'slug' => 'permanent_deleted_maintenance_category',
                'module_name' => 'Permanent Delete  Maintenance Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Maintenance Category',
                'status' => 1
            ],



            [
                'name' => 'View Deleted  Maintenance Sub Category',
                'slug' => 'view_deleted_maintenance_sub_category',
                'module_name' => 'View Deleted  Maintenance Sub Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Maintenance Sub Category',
                'status' => 1
            ],

            [
                'name' => 'Restore  Maintenance Sub Category',
                'slug' => 'restore_maintenance_sub_category',
                'module_name' => 'Restore  Maintenance Sub Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore  Maintenance Sub Category',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete  Maintenance Sub Category',
                'slug' => 'permanent_deleted_maintenance_sub_category',
                'module_name' => 'Permanent Delete  Maintenance Sub Category',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete  Maintenance Sub Category',
                'status' => 1
            ],



            //--------------


            [
                'name' => 'View Deleted Ownership',
                'slug' => 'view_deleted_ownership',
                'module_name' => 'View Deleted Ownership',
                'module_slug' => 'recycle_bin',
                'description' => 'View Deleted Ownership',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Ownership',
                'slug' => 'restore_ownership',
                'module_name' => 'Restore Ownership',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Ownership',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Ownership',
                'slug' => 'permanent_delete_ownership',
                'module_name' => 'Permanent Delete Ownership',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete Ownership',
                'status' => 1
            ],


            [
                'name' => 'View Deleted Drivers',
                'slug' => 'view_deleted_drivers',
                'module_name' => 'View Deleted Drivers',
                'module_slug' => 'recycle_bin',
                'description' => 'View Deleted Drivers',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Drivers',
                'slug' => 'restore_drivers',
                'module_name' => 'Restore Drivers',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Drivers',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Drivers',
                'slug' => 'permanent_delete_drivers',
                'module_name' => 'Permanent Delete Drivers',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete Drivers',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Cars',
                'slug' => 'view_deleted_cars',
                'module_name' => 'View Deleted Cars',
                'module_slug' => 'recycle_bin',
                'description' => 'View Deleted Cars',
                'status' => 1
            ],
            [
                'name' => 'Restore Deleted Cars',
                'slug' => 'restore_cars',
                'module_name' => 'Restore Cars',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Cars',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Cars',
                'slug' => 'permanent_delete_cars',
                'module_name' => 'Permanent Delete Cars',
                'module_slug' => 'recycle_bin',
                'description' => 'Permanent Delete Cars',
                'status' => 1
            ],



            [
                'name' => 'View Deleted Role',
                'slug' => 'view_deleted_role',
                'module_name' => 'View Deleted Role',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Roles',
                'status' => 1
            ],
            [
                'name' => 'Restore Role',
                'slug' => 'restore_role',
                'module_name' => 'Restore Role',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Roles',
                'status' => 1
            ],
            [
                'name' => 'Permanent Delete Role',
                'slug' => 'permanent_deleted_role',
                'module_name' => 'Permanent Delete Role',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Roles',
                'status' => 1
            ],





        ]);

$allPermissions = \DB::table('permissions')->get();
for($i=0; $i < count($allPermissions); $i++) {
    $permission = $allPermissions[$i];
    \DB::table('permission_role')->insert([
        'permission_id' => $permission->id,
        'role_id' => 1
    ]);
}



}
}
