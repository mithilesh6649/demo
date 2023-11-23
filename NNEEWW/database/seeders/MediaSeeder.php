<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $fullPath = env('IMAGE_BASE_URL') . '/images/media/' ;
        $fullPathNew = env('IMAGE_BASE_URL') . '/images/medias/';


        \DB::table('media')->truncate();

        \DB::table('media')->insert([
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'mobile_slider_one',
                'section' => 'Banner (  First Slider )',
                'image' => $fullPathNew . 'screenshot-1.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '428',
                'image_height' => '926',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'mobile_slider_two',
                'section' => 'Banner (  Second Slider ) ',
                'image' => $fullPathNew . 'screenshot-2.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '428',
                'image_height' => '926',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'mobile_slider_three',
                'section' => 'Banner  (  Third Slider )',
                'image' => $fullPathNew . 'screenshot-3.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '428',
                'image_height' => '926',
            ],

            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'qr_code',
                'section' => 'Banner (  QR Code ) ',
                'image' => $fullPathNew . 'qr-code.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '100',
                'image_height' => '100',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'why_gena',
                'section' => 'Why Genas HealthX ?',
                'image' => $fullPathNew . 'home-1.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1912',
                'image_height' => '416',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test',
                'section' => 'Genetic Test',
                'image' => $fullPathNew . 'lab-1.jpg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],
            //
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test_first_icon',
                'section' => 'Genetic Test ( First small icon ) ',
                'image' => $fullPathNew . 'genes.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '147',
                'image_height' => '147',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test_second_icon',
                'section' => 'Genetic Test ( Second small icon ) ',
                'image' => $fullPathNew . 'Chromosomes.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '147',
                'image_height' => '147',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test_third_icon',
                'section' => 'Genetic Test ( Third small icon ) ',
                'image' => $fullPathNew . 'Proteins.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '147',
                'image_height' => '147',
            ],

            //
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'biochemical_test',
                'section' => 'Biochemical Test',
                'image' => $fullPathNew . 'lab-2.jpg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'patient_safety',
                'section' => 'Patient Safety',
                'image' => $fullPathNew . 'lab-3.jpg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'our_app',
                'section' => 'Our App',
                'image' => $fullPathNew . 'left-download.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],
            //
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'first_image',
                'section' => 'Banner',
                'image' => $fullPathNew . 'about-99.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '693',
                'image_height' => '674',
            ],
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'our_technology_first',
                'section' => 'Our technology ( First image )',
                'image' => $fullPathNew . 'lifenomessss.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1323',
                'image_height' => '480',
            ], 
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'our_technology_second',
                'section' => 'Our technology ( Second image )',
                'image' => $fullPathNew . 'nealnome_scince11.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1522',
                'image_height' => '536',
            ],
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'gena_healthx_work',
                'section' => 'How does Gena Healthx work ?',
                'image' => $fullPathNew . 'footer-5.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1322',
                'image_height' => '221',
            ],

            //

            [
                'page_slug' => 'footer',
                'page_title' => 'Footer',
                'image_slug' => 'footer_logo',
                'section' => 'Logo',
                'image' => $fullPath . 'logo.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '300',
                'image_height' => '115',
            ],
            [
                'page_slug' => 'footer',
                'page_title' => 'Footer',
                'image_slug' => 'address_first_flag',
                'section' => 'Address ( First flag) ',
                'image' => $fullPath . 'India.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '22',
                'image_height' => '16',
            ],
            [
                'page_slug' => 'footer',
                'page_title' => 'Footer',
                'image_slug' => 'address_second_flag',
                'section' => 'Address ( Second flag )',
                'image' => $fullPath . 'Germany.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '22',
                'image_height' => '16',
            ],

             [
                'page_slug' => 'header',
                'page_title' => 'Header',
                'image_slug' => 'header_logo',
                'section' => 'Logo',
                'image' => $fullPath . 'logo-brand.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '300',
                'image_height' => '115',
            ],

            [
                'page_slug' => 'our_app',
                'page_title' => 'Our App',
                'image_slug' => 'main_logo',
                'section' => 'Our App',
                'image' => $fullPath . 'left-download.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],

 
            [
                'page_slug' => 'our_app',
                'page_title' => 'Our App',
                'image_slug' => 'first_feature',
                'section' => 'First feature',
                'image' => $fullPath . 'mobile-14.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'our_app',
                'page_title' => 'Our App',
                'image_slug' => 'second_feature',
                'section' => 'Second feature',
                'image' => $fullPath . 'mobile-1.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'our_app',
                'page_title' => 'Our App',
                'image_slug' => 'third_feature',
                'section' => 'Third feature',
                'image' => $fullPath . 'mobile-11.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'our_app',
                'page_title' => 'Our App',
                'image_slug' => 'fourth_feature',
                'section' => 'Fourth feature',
                'image' => $fullPath . 'mobile-14.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],

              [
                'page_slug' => 'know_more',
                'page_title' => 'Know More',
                'image_slug' => 'main_logo',
                'section' => 'Know More',
                'image' => $fullPath . 'left-download.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],

 
            [
                'page_slug' => 'know_more',
                'page_title' => 'Know More',
                'image_slug' => 'first_feature',
                'section' => 'First feature',
                'image' => $fullPath . 'mobile-14.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'know_more',
                'page_title' => 'Know More',
                'image_slug' => 'second_feature',
                'section' => 'Second feature',
                'image' => $fullPath . 'mobile-1.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'know_more',
                'page_title' => 'Know More',
                'image_slug' => 'third_feature',
                'section' => 'Third feature',
                'image' => $fullPath . 'mobile-11.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'know_more',
                'page_title' => 'Know More',
                'image_slug' => 'fourth_feature',
                'section' => 'Fourth feature',
                'image' => $fullPath . 'mobile-14.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],

             [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'notification_sound',
                'section' => 'Notification',
                'image' => $fullPath . 'hiring.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],

            [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'competitive_salary',
                'section' => 'Competitive salary',
                'image' => $fullPath . 'save_money.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],
          

            [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'internal_mobility',
                'section' => 'Internal mobility',
                'image' => $fullPath . 'mobility.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


           [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'friendly_policies',
                'section' => 'Friendly policies',
                'image' => $fullPath . 'policy.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


          


          [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'work_life_balance',
                'section' => 'Work life balance',
                'image' => $fullPath . 'balance.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


        [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'flexible_leave_policy',
                'section' => 'flexible leave policy',
                'image' => $fullPath . 'save_money.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],


            [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'image_slug' => 'training_and_development',
                'section' => 'Training and development',
                'image' => $fullPath . 'save_money.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '636',
                'image_height' => '400',
            ],

              [
                'page_slug' => 'subscribe_now',
                'page_title' => 'Subscribe now',
                'image_slug' => 'subscribe_now_model',
                'section' => 'Subscribe now',
                'image' => $fullPath . 'heath-care.png.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '513',
                'image_height' => '368',
            ],



            //
        ]);

    }
}
