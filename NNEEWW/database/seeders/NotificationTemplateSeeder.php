<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
 
class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fullPath = env('IMAGE_BASE_URL') . '/images/media/'.
        Schema::disableForeignKeyConstraints();
        \DB::table('notification_templates')->truncate();

        \DB::table('notification_templates')->insert([
            [
                'title' => "Water Reminder",
                'body' => "Its time pour some water in your glass",
                'notification_type' => 1,
                'notification_type_id' => 50,
                'slug' => 'water_reminder',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/water_notification.png',
                'status' => 1
            ],
            
            [
                'title' => "Medicine Reminder",
                'body' => "Did you take your medicine? Its time to take it.",
                'notification_type' => 1,
                'notification_type_id' => 51,
                'slug' => 'medicine_reminder',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/medicine_notification.png',
                'status' => 1
            ],

            [
                'title' => "Pulse Reminder",
                'body' => "Its time Check your Heart Rate",
                'notification_type' => 1,
                'notification_type_id' => 52,
                'slug' => 'pulse_reminder',
                'notification_image' =>'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/pulse_notification.png',
                'status' => 1
            ],

            [
                'title' => "Weight Reminder",
                'body' => "Now, its time to check your weight",
                'notification_type' => 1,
                'notification_type_id' => 53,
                'slug' => 'weight_reminder',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/weight_notification.png',
                'status' => 1
            ],

            [
                'title' => "Step Reminder",
                'body' => "Have you completed today steps goal?",
                'notification_type' => 1,
                'notification_type_id' => 54,
                'slug' => 'step_reminder',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/step_notification.png',
                'status' => 1
            ],

             [
                'title' => "You have a appointment request ,  Scheduled Appointment now ",
                'body' => "Appointment requested",
                'notification_type' => 1,
                'notification_type_id' => 80,
                'slug' => 'appointment_requested',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/doctor_appointment_app_img.png',
                'status' => 1
            ],


            [
                'title' => "Appointment scheduled ",
                'body' => "Hello , Your Appointment has been scheduled ",
                'notification_type' => 1,
                'notification_type_id' => 81,
                'slug' => 'appointment_scheduled',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/doctor_appointment_app_img.png',
                'status' => 1
            ],

             [
                'title' => "Appointment updated ",
                'body' => "Hello , Your Appointment has been updated ",
                'notification_type' => 1,
                'notification_type_id' => 82,
                'slug' => 'appointment_updated',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/doctor_appointment_app_img.png',
                'status' => 1
            ],

            [
                'title' => "Appointment cancelled ",
                'body' => "Hello , Your Appointment has been cancelled ",
                'notification_type' => 1,
                'notification_type_id' => 83,
                'slug' => 'appointment_cancelled',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/doctor_appointment_app_img.png',
                'status' => 1
            ],

            [
                'title' => "Notice",
                'body' => "This is important notice to all Nutritionist",
                'notification_type' => 1,
                'notification_type_id' => 84,
                'slug' => 'nutrionist_notification',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/doctor_appointment_app_img.png',
                'status' => 1
            ],

            [
                'title' => "Report Uploaded",
                'body' => "New Report has been uploaded",
                'notification_type' => 1,
                'slug' => 'report_uploaded_notification',
                'notification_type_id' => 113,
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/report.png',
                'status' => 1
            ],

            [
                'title' => "Plan Expired",
                'body' => "Your plan has been expired",
                'notification_type' => 1,
                'notification_type_id' => null,
                'slug' => 'plan_expired',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/report.png',
                'status' => 1
            ],

            [
                'title' => "Diet Plan",
                'body' => "You have assigned a new ticket",
                'notification_type' => 1,
                'notification_type_id' => null,
                'slug' => 'diet_plan_ticket',
                'notification_image' => 'https://server3.rvtechnologies.in/Gena-HealthX/admin/public/images/media/report.png',
                'status' => 1
            ],
        ]);
    }
}
