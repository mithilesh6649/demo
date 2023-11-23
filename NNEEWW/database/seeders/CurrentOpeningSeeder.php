<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrentOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('current_openings')->truncate();

        \DB::table('current_openings')->insert([
            [
                'job_title' => 'Nutritionist',
                'department' =>'Doctor',
                'description' => '<ul type="disc" style="margin-bottom: 0cm; color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small; margin-top: 0cm;"><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">A health and fitness enthusiast</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">Must have knowledge about Weight Loss and Work out progression</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; font-family: Helvetica, sans-serif; color: rgb(51, 51, 51);">Experience in Sales to handle people with a medical condition or special population</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Excellent Communication Skills</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Preferably a certified fitness trainer or Nutritionist</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Hands-on experience in the sales cycle</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Building a positive client engagement</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Ability to multi-task, prioritize, and manage time effectively</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Immediate joiner is preferred</span></li></ul>',
                'location' => 'Delhi',
                'employee_type' =>"1",
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'job_title' => 'Nutritionist',
                'department' =>'Doctor',
                'description' => '<ul type="disc" style="margin-bottom: 0cm; color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small; margin-top: 0cm;"><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">A health and fitness enthusiast</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">Must have knowledge about Weight Loss and Work out progression</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; font-family: Helvetica, sans-serif; color: rgb(51, 51, 51);">Experience in Sales to handle people with a medical condition or special population</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Excellent Communication Skills</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Preferably a certified fitness trainer or Nutritionist</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Hands-on experience in the sales cycle</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Building a positive client engagement</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Ability to multi-task, prioritize, and manage time effectively</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Immediate joiner is preferred</span></li></ul>',
                'location' => 'Delhi',
                'employee_type' =>"1",
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'job_title' => 'Nutritionist',
                'department' =>'Doctor',
                'description' => '<ul type="disc" style="margin-bottom: 0cm; color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small; margin-top: 0cm;"><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">A health and fitness enthusiast</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">Must have knowledge about Weight Loss and Work out progression</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; font-family: Helvetica, sans-serif; color: rgb(51, 51, 51);">Experience in Sales to handle people with a medical condition or special population</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Excellent Communication Skills</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Preferably a certified fitness trainer or Nutritionist</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Hands-on experience in the sales cycle</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Building a positive client engagement</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Ability to multi-task, prioritize, and manage time effectively</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Immediate joiner is preferred</span></li></ul>',
                'location' => 'Delhi',
                'employee_type' =>"1",
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'job_title' => 'Nutritionist',
                'department' =>'Doctor',
                'description' => '<ul type="disc" style="margin-bottom: 0cm; color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small; margin-top: 0cm;"><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">A health and fitness enthusiast</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt;">Must have knowledge about Weight Loss and Work out progression</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; font-family: Helvetica, sans-serif; color: rgb(51, 51, 51);">Experience in Sales to handle people with a medical condition or special population</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Excellent Communication Skills</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Preferably a certified fitness trainer or Nutritionist</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Hands-on experience in the sales cycle</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Building a positive client engagement</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Ability to multi-task, prioritize, and manage time effectively</span></li><li class="m_-7555908222605112296MsoNoSpacing" style="margin: 0cm; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10pt; color: rgb(56, 63, 68);">Immediate joiner is preferred</span></li></ul>',
                'location' => 'Delhi',
                'employee_type' =>"1",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    } 
}
