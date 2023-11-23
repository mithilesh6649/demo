<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faq')->truncate();

        \DB::table('faq')->insert([
            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],

            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],
            
            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],

            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],

            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],

            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],

            [
                'question' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'answer'  => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'type' => 'faq',
                'status' => 1
            ],

            ]);
    }
}
