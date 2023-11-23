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
        $fullPath = env('IMAGE_BASE_URL') . '/images/media/' .

        \DB::table('media')->truncate();

        \DB::table('media')->insert([
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'mobile_slider_one',
                'section' => 'Banner (  First Slider )',
                'image' => $fullPath . 'screenshot-1.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '223',
                'image_height' => '470',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'mobile_slider_two',
                'section' => 'Banner (  Second Slider ) ',
                'image' => $fullPath . 'screenshot-2.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '223',
                'image_height' => '470',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'mobile_slider_three',
                'section' => 'Banner  (  Third Slider )',
                'image' => $fullPath . 'screenshot-3.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '223',
                'image_height' => '470',
            ],

            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'qr_code',
                'section' => 'Banner (  QR Code ) ',
                'image' => $fullPath . 'qr-code.png',
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
                'image' => $fullPath . 'home-1.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '420',
                'image_height' => '1907',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test',
                'section' => 'Genetic Test',
                'image' => $fullPath . 'lab-1.jpg',
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
                'image' => $fullPath . 'genes.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '98',
                'image_height' => '98',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test_second_icon',
                'section' => 'Genetic Test ( Second small icon ) ',
                'image' => $fullPath . 'Chromosomes.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '98',
                'image_height' => '98',
            ],
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'genetic_test_third_icon',
                'section' => 'Genetic Test ( Third small icon ) ',
                'image' => $fullPath . 'Proteins.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '98',
                'image_height' => '98',
            ],

            //
            [
                'page_slug' => 'home_page',
                'page_title' => 'Home',
                'image_slug' => 'biochemical_test',
                'section' => 'Biochemical Test',
                'image' => $fullPath . 'lab-2.jpg',
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
                'image' => $fullPath . 'lab-3.jpg',
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
                'image' => $fullPath . 'left-download.png',
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
                'image' => $fullPath . 'about-99.png',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '411',
                'image_height' => '400',
            ],
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'our_technology_first',
                'section' => 'Our technology ( First image )',
                'image' => $fullPath . 'lifenomessss.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1296',
                'image_height' => '470',
            ],
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'our_technology_second',
                'section' => 'Our technology ( Second image )',
                'image' => $fullPath . 'nealnome_scince11.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1296',
                'image_height' => '216',
            ],
            [
                'page_slug' => 'about_us_page',
                'page_title' => 'About Us',
                'image_slug' => 'gena_healthx_work',
                'section' => 'How does Gena Healthx work ?',
                'image' => $fullPath . 'footer-5.svg',
                'device_type' => 'web',
                'status' => 1,
                'image_width' => '1296',
                'image_height' => '216',
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



            //
        ]);

    }
}
