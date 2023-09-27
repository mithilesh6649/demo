<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class MdDropdownsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('md_dropdowns')->truncate();
        \DB::table('md_dropdowns')->insert([

           [
            'id'=>1,
            'name'=> 'Your Taste of Spice',
            'slug'=>'choice_group',
            'value'=>'spicy'
           ],

           [
            'id'=>2,
            'name'=> 'Spicy',
            'slug'=>'spicy',
            'value'=>'spicy'
           ],

           [
            'id'=>3,
            'name'=> 'Non Spicy',
            'slug'=>'spicy',
            'value'=>' non-spicy'
           ],

           [
            'id'=>4,
            'name'=> 'Medium Spicy',
            'slug'=>'spicy',
            'value'=>'medium-spicy'
           ],
           [
            'id'=>5,
            'name'=> 'Less Spicy',
            'slug'=>'spicy',
            'value'=>'less-spicy'
           ],

           // Menu Items availability
           [
            'id'=>6,
            'name' => 'Available',
            'slug' => 'menu_item_availability',
            'value' => '1'
           ],
           [
            'id'=>7,
            'name' => 'Unavailable',
            'slug' => 'menu_item_availability',
            'value' => '0'
           ],
           [
            'id'=>8,
            'name' => 'Unavailable for 1 Hour',
            'slug' => 'menu_item_availability',
            'value' => '60'
           ],
           [
            'id'=>9,
            'name' => 'Unavailable for 2 Hour',
            'slug' => 'menu_item_availability',
            'value' => '120'
           ],
           [
            'id'=>10,
            'name' => 'Unavailable for 4 Hour',
            'slug' => 'menu_item_availability',
            'value' => '240'
           ],
           [
            'id'=>11,
            'name' => 'Unavailable Untill Next Day',
            'slug' => 'menu_item_availability',
            'value' => '1440
'
           ],
            [
            'id'=>12,
            'name' => 'Birthday Party',
            'slug' => 'celebration_type',
            'value' => 'Birthday Party'
           ],
           [
            'id'=>13,
            'name' => 'Kitti Party',
            'slug' => 'celebration_type',
            'value' => 'Kitti Party'
           ],
           [
            'id'=>14,
            'name' => 'Family Celebrations',
            'slug' => 'celebration_type',
            'value' => 'Family Celebrations'
           ],
           [
            'id'=>16,
            'name' => 'Corporate Celebrations',
            'slug' => 'celebration_type',
            'value' => 'Corporate Celebrations'
           ],
           [
            'id'=>17,
            'name' => 'Wedding',
            'slug' => 'celebration_type',
            'value' => 'Wedding'
           ],
           [
            'id'=>18,
            'name' => 'Others',
            'slug' => 'celebration_type',
            'value' => 'Others'
           ],
             [
            'id'=>19,
            'name' => '5KD',
            'slug' => 'menu_type',
            'value' => '5KD'
           ],
             [
            'id'=>20,
            'name' => '10KD',
            'slug' => 'menu_type',
            'value' => '10KD'
           ],
             [
            'id'=>21,
            'name' => '15KD',
            'slug' => 'menu_type',
            'value' => '15KD'
           ],
           [
            'id'=>22,
            'name' => 'Pending',
            'slug' => 'catering_order_status',
            'value' => '0'
           ],
           [
            'id'=>23,
            'name' => 'Completed',
            'slug' => 'catering_order_status',
            'value' => '1'
           ],
           [
            'id'=>24,
            'name' => 'Failed',
            'slug' => 'catering_order_status',
            'value' => '2'
           ],
           [
            'id'=>25,
            'name' => 'Cancelled',
            'slug' => 'catering_order_status',
            'value' => '3'
           ],
           [
            'id'=>26,
            'name' => 'Spam',
            'slug' => 'catering_order_status',
            'value' => '4'
           ],


            [
            'id'=>27,
            'name' => 'Call Center Executive(English Speaking)',
            'slug' => 'join_us',
            'value' => 'Call Center Executive(English Speaking)'
           ],
            [
            'id'=>28,
            'name' => 'Delivery Rider',
            'slug' => 'join_us',
            'value' => 'Delivery Rider'
           ],
            [
            'id'=>29,
            'name' => 'Finance',
            'slug' => 'join_us',
            'value' => 'Finance'
           ],
            [
            'id'=>30,
            'name' => 'IT Executive',
            'slug' => 'join_us',
            'value' => 'IT Executive'
           ],
            [
            'id'=>31,
            'name' => 'Kitchen Staff',
            'slug' => 'join_us',
            'value' => 'Kitchen Staff'
           ],
            [
            'id'=>32,
            'name' => 'Sales & Marketing ',
            'slug' => 'join_us',
            'value' => 'Sales & Marketing '
           ],
            [
            'id'=>33,
            'name' => 'Operations',
            'slug' => 'join_us',
            'value' => 'Operations'
           ],
            [
            'id'=>34,
            'name' => 'Outlet Manager',
            'slug' => 'join_us',
            'value' => 'Outlet Manager'
           ],
            [
            'id'=>35,
            'name' => 'Projects',
            'slug' => 'join_us',
            'value' => 'Projects'
           ],
            [
            'id'=>36,
            'name' => ' Supply Chain & Purchase',
            'slug' => 'join_us',
            'value' => ' Supply Chain & Purchase'
           ],
            [
            'id'=>37,
            'name' => ' Sales & Marketing',
            'slug' => 'join_us',
            'value' => ' Sales & Marketing'
           ],
            [
            'id'=>38,
            'name' => 'Training & Development',
            'slug' => 'join_us',
            'value' => 'Training & Development'
           ],
            [
            'id'=>39,
            'name' => 'Others',
            'slug' => 'join_us',
            'value' => 'Others'
           ],


           [
            'id'=>40,
            'name' => 'Pending',
            'slug' => 'contact_us_status',
            'value' => '0'
           ],
           [
            'id'=>41,
            'name' => 'Resolved',
            'slug' => 'contact_us_status',
            'value' => '1'
           ],
           [
            'id'=>42,
            'name' => 'Dropped',
            'slug' => 'contact_us_status',
            'value' => '2'
           ],
           [
            'id'=>43,
            'name' => 'Spam',
            'slug' => 'contact_us_status',
            'value' => '3'
           ],
           [
            'id'=>44,
            'name' => 'Pending',
            'slug' => 'join_us_status',
            'value' => '1'
           ],
           [
            'id'=>45,
            'name' => 'Rejected',
            'slug' => 'join_us_status',
            'value' => '2'
           ],
           [
            'id'=>46,
            'name' => 'Spam',
            'slug' => 'join_us_status',
            'value' => '3'
           ],
           [
            'id'=>47,
            'name' => 'Accepted',
            'slug' => 'join_us_status',
            'value' => '4'
           ],
           [
            'id'=>48,
            'name' => 'Home Page',
            'slug' => 'pages_name',
            'value' => 'home_page'
           ],
           [
            'id'=>49,
            'name' => 'Order Online',
            'slug' => 'pages_name',
            'value' => 'order_online'
           ],

           [
            'id'=>50,
            'name' => 'Contact Us',
            'slug' => 'pages_name',
            'value' => 'contact_us'
           ],
            [
            'id'=>51,
            'name' => 'About Us',
            'slug' => 'pages_name',
            'value' => 'about_us'
            ],
            [
            'id'=>52,
            'name' => 'Loyality',
            'slug' => 'pages_name',
            'value' => 'loyality'
           ],
           [
            'id'=>53,
            'name' => 'Outlets',
            'slug' => 'pages_name',
            'value' => 'outlets'
           ],
           [
            'id'=>54,
            'name' => 'Dine in',
            'slug' => 'pages_name',
            'value' => 'dine_in'
           ],
           [
            'id'=>55,
            'name' => 'Catering',
            'slug' => 'pages_name',
            'value' => 'catering'
           ],
            [
            'id'=>56,
            'name' => 'Blog',
            'slug' => 'pages_name',
            'value' => 'blog'
           ],
            [
            'id'=>57,
            'name' => 'Menu',
            'slug' => 'pages_name',
            'value' => 'menu'
           ],
            [
            'id'=>58,
            'name' => 'MM Cares',
            'slug' => 'pages_name',
            'value' => 'mm_cares'
           ],


            [
            'id'=>59,
            'name' => 'Join Us',
            'slug' => 'pages_name',
            'value' => 'join_us'
           ],
            [
            'id'=>60,
            'name' => 'Sponsor a Biryani',
            'slug' => 'pages_name',
            'value' => 'sponsor_a_biryani'
           ],
           [
            'id'=>61,
            'name' => 'Unsubscribe',
            'slug' => 'pages_name',
            'value' => 'unsubscribe'
           ],
           [
            'id'=>62,
            'name' => 'Our Vision',
            'slug' => 'pages_name',
            'value' => 'our_vision'
           ],
           [
            'id'=>63,
            'name' => 'Placed',
            'slug' => 'order_summary',
            'value' => 'placed'
           ],
             [
            'id'=>64,
            'name' => 'Accepted',
            'slug' => 'order_summary',
            'value' => 'accepted'
           ],
           [
            'id'=>68,
            'name' => 'Delivered',
            'slug' => 'order_summary',
            'value' => 'delivered'
           ],
            [
            'id'=>69,
            'name' => 'Cancelled',
            'slug' => 'order_summary',
            'value' => 'cancelled'
           ],
            [
            'id'=>70,
            'name' => 'Active',
            'slug' => 'status_data',
            'value' => '1'
           ],
            [
            'id'=>71,
            'name' => 'Inactive',
            'slug' => 'status_data',
            'value' => '0'
           ],
            [
            'id'=>72,
            'name' => 'loyality_level',
            'slug' => 'rewards_programm',
            'value' => 'Loyalty Level'
           ],
            [
            'id'=>73,
            'name' => 'sign_up',
            'slug' => 'rewards_programm',
            'value' => 'Sign Up'
           ],
            [
            'id'=>74,
            'name' => 'referral',
            'slug' => 'rewards_programm',
            'value' => 'Referral'
           ],
             [
            'id'=>75,
            'name' => 'online_order',
            'slug' => 'rewards_programm',
            'value' => 'Online Order'
           ],
            [
            'id'=>76,
            'name' => 'dine_in',
            'slug' => 'rewards_programm',
            'value' => 'Dine In'
           ],
           [
            'id'=>77,
            'name' => 'Amount',
            'slug' => 'offer_type',
            'value' => '1'
           ],
            [
            'id'=>78,
            'name' => 'Percentage',
            'slug' => 'offer_type',
            'value' => '0'
           ],

           [
            'id'=>79,
            'name' => '3 KD ',
            'slug' => 'gift_card_type',
            'value' => '3_kd'
           ],
            [
            'id'=>80,
            'name' => '5 KD',
            'slug' => 'gift_card_type',
            'value' => '5_kd'
           ],
           
           [
            'id'=>81,
            'name' => '10 KD',
            'slug' => 'gift_card_type',
            'value' => '10_kd'
           ],
           [
            'id'=>82,
            'name' => '20 KD',
            'slug' => 'gift_card_type',
            'value' => '20_kd'
           ],

           [
            'id'=>83,
            'name' => 'Block',
            'slug' => 'block_data',
            'value' => '1'
           ],
          [
            'id'=>84,
            'name' => 'Unblock',
            'slug' => 'block_data',
            'value' => '0'
           ],
           [
            'id'=>85,
            'name'=> 'Vehicle Maintenance',
            'slug' => 'maintenance',
            'value' => '1',
           ],
           [
            'id'=>86,
            'name'=> 'Restaurant Maintenance',
            'slug' => 'maintenance',
            'value' => '2',
           ],

            [
            'id'=>87,
            'name'=> 'Discount',
            'slug' => 'daily_invoice_type',
            'value' => 'discount',
           ],
            [
            'id'=>88,
            'name'=> 'Complimentary',
            'slug' => 'daily_invoice_type',
            'value' => 'complimentary',
           ],
            [
            'id'=>89,
            'name'=> 'Cash Deposit In Bank',
            'slug' => 'daily_invoice_type',
            'value' => 'cash_deposit_in_bank',
           ],
            [
            'id'=>90,
            'name'=> 'Report From ICG',
            'slug' => 'daily_invoice_type',
            'value' => 'report_from_icg',
           ],
            [
            'id'=>91,
            'name'=> 'Cheque',
            'slug' => 'daily_invoice_type',
            'value' => 'cheque',
           ],
           [
            'id'=>92,
            'name'=> 'Printed Gift Card',
            'slug' => 'daily_invoice_type',
            'value' => 'printed_gift_cards',
           ],
           [
            'id'=>93,
            'name'=> 'E-Gift Card',
            'slug' => 'daily_invoice_type',
            'value' => 'e_gift_card',
           ],
           [
            'id'=>94,
            'name'=> 'Coupon/Voucher',
            'slug' => 'daily_invoice_type',
            'value' => 'gift_coupon_or_voucher',
           ],
           [
            'id'=>95,
            'name'=> 'Kent Reconciliation',
            'slug' => 'daily_invoice_type',
            'value' => 'kent_reconciliation',
           ],
           [
            'id'=>96,
            'name'=> 'Shortage invoice',
            'slug' => 'daily_invoice_type',
            'value' => 'shortage_invoice',
           ],
             [
            'id'=>97,
            'name'=> ' Buffet',
            'slug' => 'daily_invoice_type',
            'value' => 'buffet',
           ],

           [
            'id'=>98,
            'name'=> 'Cash',
            'slug' => 'cash_received_by',
            'value' => 'cash',
           ],
           [
            'id'=>99,
            'name'=> 'Cheque',
            'slug' => 'cash_received_by',
            'value' => 'cheque',
           ],

            [
            'id'=>100,
            'name'=> 'Offer',
            'slug' => 'current_offer_type',
            'value' =>0,
           ],
           [
            'id'=>101,
            'name'=> 'Ads',
            'slug' => 'current_offer_type',
            'value' =>1,
           ],

        ]);
    }
}
