<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //\DB::table('permission_role')->truncate();

        \DB::table('permissions')->truncate();
        \DB::table('permissions')->insert([
            // User Types

            // USER MANAGEMENT //

            // // Users
            [
                'name' => 'Add',
                'slug' => 'add_user',
                'module_name' => 'Users',
                'module_slug' => 'users',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_user',
                'module_name' => 'Users',
                'module_slug' => 'users',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_user',
                'module_name' => 'Users',
                'module_slug' => 'users',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_user',
                'module_name' => 'Users',
                'module_slug' => 'users',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Nutritionist
            [
                'name' => 'Add',
                'slug' => 'add_nutritionist',
                'module_name' => 'Nutritionist',
                'module_slug' => 'nutritionist',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_nutritionist',
                'module_name' => 'Nutritionist',
                'module_slug' => 'nutritionist',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_nutritionist',
                'module_name' => 'Nutritionist',
                'module_slug' => 'nutritionist',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_nutritionist',
                'module_name' => 'Nutritionist',
                'module_slug' => 'nutritionist',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Admins
            [
                'name' => 'Add',
                'slug' => 'add_admin',
                'module_name' => 'Admins',
                'module_slug' => 'admins',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_admin',
                'module_name' => 'Admins',
                'module_slug' => 'admins',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_admin',
                'module_name' => 'Admins',
                'module_slug' => 'admins',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_admin',
                'module_name' => 'Admins',
                'module_slug' => 'admins',
                'description' => 'desc',
                'status' => 1,
            ],

             [
                'name' => 'View',
                'slug' => 'view_subscribers',
                'module_name' => 'View',
                'module_slug' => 'manage_subscribers',
                'description' => 'Manage Subscribers',
                'status' => 1,
            ],

            // APPOINTMENTS MANAGEMENT //

            // // APPOINTMENTS
            [
                'name' => 'Add',
                'slug' => 'add_appointments',
                'module_name' => 'Appointments',
                'module_slug' => 'appointments',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_appointments',
                'module_name' => 'Appointments',
                'module_slug' => 'appointments',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_appointments',
                'module_name' => 'Appointments',
                'module_slug' => 'appointments',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_appointments',
                'module_name' => 'Appointments',
                'module_slug' => 'appointments',
                'description' => 'desc',
                'status' => 1,
            ],



             // // test_reports
            
            [
                'name' => 'Upload',
                'slug' => 'upload_test_reports',
                'module_name' => 'test_reports',
                'module_slug' => 'test_reports',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_test_reports',
                'module_name' => 'test_reports',
                'module_slug' => 'test_reports',
                'description' => 'desc',
                'status' => 1,
            ],

            // LABORATORIES MANAGEMENT //

            // // LABORATORIES
            [
                'name' => 'Add',
                'slug' => 'add_laboratories',
                'module_name' => 'Laboratories',
                'module_slug' => 'laboratories',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_laboratories',
                'module_name' => 'Laboratories',
                'module_slug' => 'laboratories',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_laboratories',
                'module_name' => 'Laboratories',
                'module_slug' => 'laboratories',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_laboratories',
                'module_name' => 'Laboratories',
                'module_slug' => 'laboratories',
                'description' => 'desc',
                'status' => 1,
            ],
            
            //Meal Template

             [
                'name' => 'View',
                'slug' => 'view_meal_template',
                'module_name' => 'meal_template',
                'module_slug' => 'meal_template',
                'description' => 'Meal Template',
                'status' => 1,
            ],

            // // Consultation Session

            [
                'name' => 'Delete',
                'slug' => 'delete_consultation_session',
                'module_name' => 'Consultation session',
                'module_slug' => 'consultation_session',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_consultation_session',
                'module_name' => 'Consultation session',
                'module_slug' => 'consultation_session',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Job
            [
                'name' => 'Add',
                'slug' => 'add_job',
                'module_name' => 'job',
                'module_slug' => 'job',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_job',
                'module_name' => 'job',
                'module_slug' => 'job',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_job',
                'module_name' => 'job',
                'module_slug' => 'job',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_job',
                'module_name' => 'job',
                'module_slug' => 'job',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Exercises
            [
                'name' => 'Add',
                'slug' => 'add_exercises',
                'module_name' => 'exercises',
                'module_slug' => 'exercises',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_exercises',
                'module_name' => 'exercises',
                'module_slug' => 'exercises',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_exercises',
                'module_name' => 'exercises',
                'module_slug' => 'exercises',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_exercises',
                'module_name' => 'exercises',
                'module_slug' => 'exercises',
                'description' => 'desc',
                'status' => 1,
            ],
             

              // // Food
            [
                'name' => 'Add',
                'slug' => 'add_food',
                'module_name' => 'food',
                'module_slug' => 'food',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_food',
                'module_name' => 'food',
                'module_slug' => 'food',
                'description' => 'desc',
                'status' => 1,
            ],
            // [
            //     'name' => 'Delete',
            //     'slug' => 'delete_food',
            //     'module_name' => 'food',
            //     'module_slug' => 'food',
            //     'description' => 'desc',
            //     'status' => 1,
            // ],
            [
                'name' => 'View',
                'slug' => 'view_food',
                'module_name' => 'food',
                'module_slug' => 'food',
                'description' => 'desc',
                'status' => 1,
            ],
           

             // // Recommended Dietary Allowance
            [
                'name' => 'Add',
                'slug' => 'add_rda',
                'module_name' => 'rda',
                'module_slug' => 'rda',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_rda',
                'module_name' => 'rda',
                'module_slug' => 'rda',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_rda',
                'module_name' => 'rda',
                'module_slug' => 'rda',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_rda',
                'module_name' => 'rda',
                'module_slug' => 'rda',
                'description' => 'desc',
                'status' => 1,
            ],


               // // Trait Categories
            [
                'name' => 'Add',
                'slug' => 'add_trait_category',
                'module_name' => 'trait_category',
                'module_slug' => 'trait_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_trait_category',
                'module_name' => 'trait_category',
                'module_slug' => 'trait_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_trait_category',
                'module_name' => 'trait_category',
                'module_slug' => 'trait_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_trait_category',
                'module_name' => 'trait_category',
                'module_slug' => 'trait_category',
                'description' => 'desc',
                'status' => 1,
            ],


              // // Trait  
            [
                'name' => 'Add',
                'slug' => 'add_trait',
                'module_name' => 'trait',
                'module_slug' => 'trait',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_trait',
                'module_name' => 'trait',
                'module_slug' => 'trait',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_trait',
                'module_name' => 'trait',
                'module_slug' => 'trait',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_trait',
                'module_name' => 'trait',
                'module_slug' => 'trait',
                'description' => 'desc',
                'status' => 1,
            ],

          // // Help & Support help_and_support
          
            [
                'name' => 'Edit',
                'slug' => 'edit_help_and_support',
                'module_name' => 'help_and_support',
                'module_slug' => 'help_and_support',
                'description' => 'desc',
                'status' => 1,
            ],
           
            [
                'name' => 'View',
                'slug' => 'view_help_and_support',
                'module_name' => 'help_and_support',
                'module_slug' => 'help_and_support',
                'description' => 'desc',
                'status' => 1,
            ],

            // // User's Feedback
            [
                'name' => 'Add',
                'slug' => 'add_review',
                'module_name' => 'review',
                'module_slug' => 'review',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_review',
                'module_name' => 'review',
                'module_slug' => 'review',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_review',
                'module_name' => 'review',
                'module_slug' => 'review',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_review',
                'module_name' => 'review',
                'module_slug' => 'review',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_contact_us',
                'module_name' => 'View',
                'module_slug' => 'manage_contact_us',
                'description' => 'Manage Contact Us',
                'status' => 1,
            ],
            // [
            //     'name' => 'Edit',
            //     'slug' => 'edit_contact_us',
            //     'module_name' => 'Edit',
            //     'module_slug' => 'manage_contact_us',
            //     'description' => 'Manage Contact Us',
            //     'status' => 1
            // ],
            [
                'name' => 'Reply',
                'slug' => 'reply_contact_us',
                'module_name' => 'Reply',
                'module_slug' => 'manage_contact_us',
                'description' => 'Manage Contact Us',
                'status' => 1,
            ],

           

            //referral_patients

            [
                'name' => 'Delete',
                'slug' => 'delete_referral_patients',
                'module_name' => 'Referral patients',
                'module_slug' => 'referral_patients',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_referral_patients',
                'module_name' => 'Referral patients',
                'module_slug' => 'referral_patients',
                'description' => 'desc',
                'status' => 1,
            ],

            // CONTENT  MANAGEMENT //

            // // MEDIA
            [
                'name' => 'Edit',
                'slug' => 'edit_media',
                'module_name' => 'Media',
                'module_slug' => 'media',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_media',
                'module_name' => 'Media',
                'module_slug' => 'media',
                'description' => 'desc',
                'status' => 1,
            ],

            // // WEBSITE PAGE
            [
                'name' => 'Edit',
                'slug' => 'edit_website',
                'module_name' => 'Website',
                'module_slug' => 'website',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_website',
                'module_name' => 'Website',
                'module_slug' => 'website',
                'description' => 'desc',
                'status' => 1,
            ],

            // // WEBSITE PAGE
            [
                'name' => 'Edit',
                'slug' => 'edit_mobile',
                'module_name' => 'Mobile',
                'module_slug' => 'mobile',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_mobile',
                'module_name' => 'Mobile',
                'module_slug' => 'mobile',
                'description' => 'desc',
                'status' => 1,
            ],

            // // SOCIAL LINKS
            [
                'name' => 'Add',
                'slug' => 'add_social_links',
                'module_name' => 'Social links',
                'module_slug' => 'social_links',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_social_links',
                'module_name' => 'Social links',
                'module_slug' => 'social_links',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_social_links',
                'module_name' => 'Social links',
                'module_slug' => 'social_links',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_social_links',
                'module_name' => 'Social links',
                'module_slug' => 'social_links',
                'description' => 'desc',
                'status' => 1,
            ],

            // MISC DATA MANAGEMENT //

            // // SUBSCRIPTION PLAN
            [
                'name' => 'Add',
                'slug' => 'add_subscription_plans',
                'module_name' => 'subscription_plans',
                'module_slug' => 'subscription_plans',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_subscription_plans',
                'module_name' => 'subscription_plans',
                'module_slug' => 'subscription_plans',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_subscription_plans',
                'module_name' => 'subscription_plans',
                'module_slug' => 'subscription_plans',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_subscription_plans',
                'module_name' => 'subscription_plans',
                'module_slug' => 'subscription_plans',
                'description' => 'desc',
                'status' => 1,
            ],

            // // SPECIALIZATIONS
            [
                'name' => 'Add',
                'slug' => 'add_specialization',
                'module_name' => 'Specialization',
                'module_slug' => 'specialization',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_specialization',
                'module_name' => 'Specialization',
                'module_slug' => 'specialization',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_specialization',
                'module_name' => 'Specialization',
                'module_slug' => 'specialization',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_specialization',
                'module_name' => 'Specialization',
                'module_slug' => 'specialization',
                'description' => 'desc',
                'status' => 1,
            ],

            // // PROJECT FEATURES
            [
                'name' => 'Add',
                'slug' => 'add_project_features',
                'module_name' => 'Project Features',
                'module_slug' => 'project_features',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_project_features',
                'module_name' => 'Project Features',
                'module_slug' => 'project_features',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_project_features',
                'module_name' => 'Project Features',
                'module_slug' => 'project_features',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_project_features',
                'module_name' => 'Project Features',
                'module_slug' => 'project_features',
                'description' => 'desc',
                'status' => 1,
            ],

            // // OUR TEAM
            [
                'name' => 'Add',
                'slug' => 'add_our_team',
                'module_name' => 'Our Team',
                'module_slug' => 'our_team',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_our_team',
                'module_name' => 'Our Team',
                'module_slug' => 'our_team',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_our_team',
                'module_name' => 'Our Team',
                'module_slug' => 'our_team',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_our_team',
                'module_name' => 'Our Team',
                'module_slug' => 'our_team',
                'description' => 'desc',
                'status' => 1,
            ],

            // // TEST
            [
                'name' => 'Add',
                'slug' => 'add_test',
                'module_name' => 'Test',
                'module_slug' => 'test',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_test',
                'module_name' => 'Test',
                'module_slug' => 'test',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_test',
                'module_name' => 'Test',
                'module_slug' => 'test',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_test',
                'module_name' => 'Test',
                'module_slug' => 'test',
                'description' => 'desc',
                'status' => 1,
            ],

            //Additional Test Discount

            [
                'name' => 'Edit Additional Test Discount',
                'slug' => 'edit_additional_test_discount',
                'module_name' => 'Additional Test Discount',
                'module_slug' => 'test',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View Additional Test Discount',
                'slug' => 'view_additional_test_discount',
                'module_name' => 'Additional Test Discount',
                'module_slug' => 'test',
                'description' => 'desc',
                'status' => 1,
            ],

            // Consultations

            [
                'name' => 'Edit',
                'slug' => 'edit_consultations',
                'module_name' => 'Consultations',
                'module_slug' => 'consultations',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_consultations',
                'module_name' => 'Consultations',
                'module_slug' => 'consultations',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Blog
            [
                'name' => 'Add',
                'slug' => 'add_blog',
                'module_name' => 'blog',
                'module_slug' => 'blog',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_blog',
                'module_name' => 'blog',
                'module_slug' => 'blog',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_blog',
                'module_name' => 'blog',
                'module_slug' => 'blog',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_blog',
                'module_name' => 'blog',
                'module_slug' => 'blog',
                'description' => 'desc',
                'status' => 1,
            ],

            // HEALTH COMPLAINT MANAGEMENT //

            // // DISEASE
            [
                'name' => 'Add',
                'slug' => 'add_diseases',
                'module_name' => 'Diseases',
                'module_slug' => 'diseases',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_diseases',
                'module_name' => 'Diseases',
                'module_slug' => 'diseases',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_diseases',
                'module_name' => 'Diseases',
                'module_slug' => 'diseases',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_diseases',
                'module_name' => 'Diseases',
                'module_slug' => 'diseases',
                'description' => 'desc',
                'status' => 1,
            ],

            // // ALLERGY
            [
                'name' => 'Add',
                'slug' => 'add_allergies',
                'module_name' => 'Allergies',
                'module_slug' => 'allergies',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_allergies',
                'module_name' => 'Allergies',
                'module_slug' => 'allergies',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_allergies',
                'module_name' => 'Allergies',
                'module_slug' => 'allergies',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_allergies',
                'module_name' => 'Allergies',
                'module_slug' => 'allergies',
                'description' => 'desc',
                'status' => 1,
            ],

            //RECIPE MANAGEMENT

            // // RECIPE     Categories
            [
                'name' => 'Add',
                'slug' => 'add_recipe_category',
                'module_name' => 'Recipe Category',
                'module_slug' => 'recipe_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_recipe_category',
                'module_name' => 'Recipe Category',
                'module_slug' => 'recipe_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_recipe_category',
                'module_name' => 'Recipe Category',
                'module_slug' => 'recipe_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_recipe_category',
                'module_name' => 'Recipe Category',
                'module_slug' => 'recipe_category',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Diet
            [
                'name' => 'Add',
                'slug' => 'add_recipe',
                'module_name' => 'Recipe',
                'module_slug' => 'recipe',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_recipe',
                'module_name' => 'Recipe',
                'module_slug' => 'recipe',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_recipe',
                'module_name' => 'Recipe',
                'module_slug' => 'recipe',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_recipe',
                'module_name' => 'Recipe',
                'module_slug' => 'recipe',
                'description' => 'desc',
                'status' => 1,
            ],

            //Diet Subscription Plans 

            [
                'name' => 'Edit',
                'slug' => 'edit_diet_subscription_plans',
                'module_name' => 'Diet Subscription Plans',
                'module_slug' => 'diet_subscription_plans',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_diet_subscription_plans',
                'module_name' => 'Diet Subscription Plans',
                'module_slug' => 'diet_subscription_plans',
                'description' => 'desc',
                'status' => 1,
            ],


              //Diet Subscription Sub Plans 

            [
                'name' => 'Edit',
                'slug' => 'edit_diet_subscription_sub_plans',
                'module_name' => 'Diet Subscription Sub Plans',
                'module_slug' => 'diet_subscription_sub_plans',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_diet_subscription_sub_plans',
                'module_name' => 'Diet Subscription Sub Plans',
                'module_slug' => 'diet_subscription_sub_plans',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Diet Categories
            [
                'name' => 'Add',
                'slug' => 'add_diet_category',
                'module_name' => 'Diet Category',
                'module_slug' => 'diet_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_diet_category',
                'module_name' => 'Diet Category',
                'module_slug' => 'diet_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_diet_category',
                'module_name' => 'Diet Category',
                'module_slug' => 'diet_category',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_diet_category',
                'module_name' => 'Diet Category',
                'module_slug' => 'diet_category',
                'description' => 'desc',
                'status' => 1,
            ],

            // // Diet
            [
                'name' => 'Add',
                'slug' => 'add_diet',
                'module_name' => 'Diet',
                'module_slug' => 'diet',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_diet',
                'module_name' => 'Diet',
                'module_slug' => 'diet',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_diet',
                'module_name' => 'Diet',
                'module_slug' => 'diet',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_diet',
                'module_name' => 'Diet',
                'module_slug' => 'diet',
                'description' => 'desc',
                'status' => 1,
            ],

            // SETTINGS MANAGEMENT //

            // // CONFIDENTIAL API KEY

            [
                'name' => 'Edit',
                'slug' => 'edit_api_keys',
                'module_name' => 'CONFIDENTIAL API KEY',
                'module_slug' => 'api_keys',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_api_keys',
                'module_name' => 'CONFIDENTIAL API KEY',
                'module_slug' => 'api_keys',
                'description' => 'desc',
                'status' => 1,
            ],

            // // NOTIFICATIONS
            [
                'name' => 'Add',
                'slug' => 'add_notification',
                'module_name' => 'Notification',
                'module_slug' => 'notification',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_notification',
                'module_name' => 'Notification',
                'module_slug' => 'notification',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_notification',
                'module_name' => 'Notification',
                'module_slug' => 'notification',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_notification',
                'module_name' => 'Notification',
                'module_slug' => 'notification',
                'description' => 'desc',
                'status' => 1,
            ],

            // Your Health Guide Message



            [
                'name' => 'Edit',
                'slug' => 'edit_guide_message',
                'module_name' => 'Your Health Guide Message',
                'module_slug' => 'guide_message',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_guide_message',
                'module_name' => 'Your Health Guide Message',
                'module_slug' => 'guide_message',
                'description' => 'desc',
                'status' => 1,
            ],

            // Roles
            [
                'name' => 'Add',
                'slug' => 'add_role',
                'module_name' => 'Roles',
                'module_slug' => 'roles',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_role',
                'module_name' => 'Roles',
                'module_slug' => 'roles',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_role',
                'module_name' => 'Roles',
                'module_slug' => 'roles',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_role',
                'module_name' => 'Roles',
                'module_slug' => 'roles',
                'description' => 'desc',
                'status' => 1,
            ],

            // Permissions
            [
                'name' => 'Edit',
                'slug' => 'edit_permissions',
                'module_name' => 'Permissions',
                'module_slug' => 'permissions',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_permissions',
                'module_name' => 'Permissions',
                'module_slug' => 'permissions',
                'description' => 'desc',
                'status' => 1,
            ],

            // Diet Subscription Features

            [
                'name' => 'Add',
                'slug' => 'add_diet_subscription_features',
                'module_name' => 'Diet Subscription Feature',
                'module_slug' => 'diet_subscription_features',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Edit',
                'slug' => 'edit_diet_subscription_features',
                'module_name' => 'Diet Subscription Feature',
                'module_slug' => 'diet_subscription_features',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'Delete',
                'slug' => 'delete_diet_subscription_features',
                'module_name' => 'Diet Subscription Feature',
                'module_slug' => 'diet_subscription_features',
                'description' => 'desc',
                'status' => 1,
            ],
            [
                'name' => 'View',
                'slug' => 'view_diet_subscription_features',
                'module_name' => 'Diet Subscription Feature',
                'module_slug' => 'diet_subscription_features',
                'description' => 'desc',
                'status' => 1,
            ],

            [
                'name' => 'View',
                'slug' => 'view_payment_transactions',
                'module_name' => 'Payment Transactions',
                'module_slug' => 'payment_transactions',
                'description' => 'desc',
                'status' => 1,
            ],
            // // Recycle Bin

            [
                'name' => 'View Deleted User',
                'slug' => 'view_deleted_user',
                'module_name' => 'View Deleted User',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete User',
                'status' => 1,
            ],
            [
                'name' => 'Restore User',
                'slug' => 'restore_user',
                'module_name' => 'Restore User',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore User',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete User',
                'slug' => 'permanent_deleted_user',
                'module_name' => 'Permanent Delete User',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete User',
                'status' => 1,
            ],
            [
                'name' => 'View Deleted Nutritionist',
                'slug' => 'view_deleted_nutrionists',
                'module_name' => 'View Deleted Nutritionist',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Nutritionist',
                'status' => 1,
            ],
            [
                'name' => 'Restore Nutritionist',
                'slug' => 'restore_nutrionists',
                'module_name' => 'Restore Nutritionist',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Nutritionist',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Nutritionist',
                'slug' => 'permanent_deleted_nutrionists',
                'module_name' => 'Permanent Delete Nutritionist',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Nutritionist',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Admin',
                'slug' => 'view_deleted_admin',
                'module_name' => 'View Deleted Admin',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Admins',
                'status' => 1,
            ],
            [
                'name' => 'Restore Admin',
                'slug' => 'restore_admin',
                'module_name' => 'Restore Admin',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Admins',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Admin',
                'slug' => 'permanent_deleted_admin',
                'module_name' => 'Permanent Delete Admin',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Admin',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Laboratory',
                'slug' => 'view_deleted_laboratory',
                'module_name' => 'View Deleted Laboratory',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Laboratorys',
                'status' => 1,
            ],
            [
                'name' => 'Restore Laboratory',
                'slug' => 'restore_laboratory',
                'module_name' => 'Restore Laboratory',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Laboratorys',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Laboratory',
                'slug' => 'permanent_deleted_laboratory',
                'module_name' => 'Permanent Delete Laboratory',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Laboratory',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Consultant Session',
                'slug' => 'view_deleted_consultant_sessions',
                'module_name' => 'View Deleted Consultant Session',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Consultant Session',
                'status' => 1,
            ],
            [
                'name' => 'Restore Consultant Session',
                'slug' => 'restore_consultant_sessions',
                'module_name' => 'Restore Consultant Session',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Consultant Session',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Consultant Session',
                'slug' => 'permanent_deleted_consultant_sessions',
                'module_name' => 'Permanent Delete Consultant Session',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Consultant Session',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Clinicians',
                'slug' => 'view_deleted_clinicians',
                'module_name' => 'View Deleted Clinicians',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Clinicians',
                'status' => 1,
            ],
            [
                'name' => 'Restore Clinicians',
                'slug' => 'restore_clinicians',
                'module_name' => 'Restore Clinicians',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Clinicians',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Clinicians',
                'slug' => 'permanent_deleted_clinicians',
                'module_name' => 'Permanent Delete Clinicians',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Clinicians',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Testimonials',
                'slug' => 'view_deleted_testimonials',
                'module_name' => 'View Deleted Testimonials',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Testimonials',
                'status' => 1,
            ],
            [
                'name' => 'Restore Testimonials',
                'slug' => 'restore_testimonials',
                'module_name' => 'Restore Testimonials',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Testimonials',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Testimonials',
                'slug' => 'permanent_deleted_testimonials',
                'module_name' => 'Permanent Delete Testimonials',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Testimonials',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Social Links',
                'slug' => 'view_deleted_social_links',
                'module_name' => 'View Deleted Social Links',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Social Links',
                'status' => 1,
            ],
            [
                'name' => 'Restore Social Links',
                'slug' => 'restore_social_links',
                'module_name' => 'Restore Social Links',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Social Links',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Social Links',
                'slug' => 'permanent_deleted_social_links',
                'module_name' => 'Permanent Delete Social Links',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Social Links',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Blogs',
                'slug' => 'view_deleted_blog',
                'module_name' => 'View Deleted Blogs',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Blogs',
                'status' => 1,
            ],
            [
                'name' => 'Restore Blogs',
                'slug' => 'restore_blog',
                'module_name' => 'Restore Blogs',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Blogs',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Blogs',
                'slug' => 'permanent_deleted_blog',
                'module_name' => 'Permanent Delete Blogs',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Blogs',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Specialization',
                'slug' => 'view_deleted_specialization',
                'module_name' => 'View Deleted Specialization',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Specialization',
                'status' => 1,
            ],
            [
                'name' => 'Restore Specialization',
                'slug' => 'restore_specialization',
                'module_name' => 'Restore Specialization',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Specialization',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Specialization',
                'slug' => 'permanent_deleted_specialization',
                'module_name' => 'Permanent Delete Specialization',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Specialization',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Health Complaints',
                'slug' => 'view_deleted_health_complaints',
                'module_name' => 'View Deleted Health Complaints',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Health Complaints',
                'status' => 1,
            ],
            [
                'name' => 'Restore Health Complaints',
                'slug' => 'restore_health_complaints',
                'module_name' => 'Restore Health Complaints',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Health Complaints',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Health Complaints',
                'slug' => 'permanent_deleted_health_complaints',
                'module_name' => 'Permanent Delete Health Complaints',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Health Complaints',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Our Teams',
                'slug' => 'view_deleted_our_teams',
                'module_name' => 'View Deleted Our Teams',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Our Teams',
                'status' => 1,
            ],
            [
                'name' => 'Restore Our Teams',
                'slug' => 'restore_our_teams',
                'module_name' => 'Restore Our Teams',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Our Teams',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Our Teams',
                'slug' => 'permanent_deleted_our_teams',
                'module_name' => 'Permanent Delete Our Teams',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Our Teams',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Test',
                'slug' => 'view_deleted_test',
                'module_name' => 'View Deleted Test',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Test',
                'status' => 1,
            ],
            [
                'name' => 'Restore Test',
                'slug' => 'restore_test',
                'module_name' => 'Restore Test',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Test',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Test',
                'slug' => 'permanent_deleted_test',
                'module_name' => 'Permanent Delete Test',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Test',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Job',
                'slug' => 'view_deleted_job',
                'module_name' => 'View Deleted Job',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Job',
                'status' => 1,
            ],
            [
                'name' => 'Restore Job',
                'slug' => 'restore_job',
                'module_name' => 'Restore Job',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Job',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Job',
                'slug' => 'permanent_deleted_job',
                'module_name' => 'Permanent Delete Job',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Job',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Exercise',
                'slug' => 'view_deleted_exercise',
                'module_name' => 'View Deleted Exercise',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Exercise',
                'status' => 1,
            ],
            [
                'name' => 'Restore Exercise',
                'slug' => 'restore_exercise',
                'module_name' => 'Restore Exercise',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Exercise',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Exercise',
                'slug' => 'permanent_deleted_exercise',
                'module_name' => 'Permanent Delete Exercise',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Exercise',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Recipe Categories',
                'slug' => 'view_deleted_recipe_categories',
                'module_name' => 'View Deleted Recipe Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Recipe Categories',
                'status' => 1,
            ],
            [
                'name' => 'Restore Recipe Categories',
                'slug' => 'restore_recipe_categories',
                'module_name' => 'Restore Recipe Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Recipe Categories',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Recipe Categories',
                'slug' => 'permanent_deleted_recipe_categories',
                'module_name' => 'Permanent Delete Recipe Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Recipe Categories',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Recipe',
                'slug' => 'view_deleted_recipe',
                'module_name' => 'View Deleted Recipe',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Recipe',
                'status' => 1,
            ],
            [
                'name' => 'Restore Recipe',
                'slug' => 'restore_recipe',
                'module_name' => 'Restore Recipe',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Recipe',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Recipe',
                'slug' => 'permanent_deleted_recipe',
                'module_name' => 'Permanent Delete Recipe',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Recipe',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Diet Categories',
                'slug' => 'view_deleted_diet_categories',
                'module_name' => 'View Deleted Diet Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Diet Categories',
                'status' => 1,
            ],
            [
                'name' => 'Restore Diet Categories',
                'slug' => 'restore_diet_categories',
                'module_name' => 'Restore Diet Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Diet Categories',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Diet Categories',
                'slug' => 'permanent_deleted_diet_categories',
                'module_name' => 'Permanent Delete Diet Categories',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Diet Categories',
                'status' => 1,
            ],

            [
                'name' => 'View Deleted Diet',
                'slug' => 'view_deleted_diet',
                'module_name' => 'View Deleted Diet',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Diet',
                'status' => 1,
            ],
            [
                'name' => 'Restore Diet',
                'slug' => 'restore_diet',
                'module_name' => 'Restore Diet',
                'module_slug' => 'recycle_bin',
                'description' => 'Restore Diet',
                'status' => 1,
            ],
            [
                'name' => 'Permanent Delete Diet',
                'slug' => 'permanent_deleted_diet',
                'module_name' => 'Permanent Delete Diet',
                'module_slug' => 'recycle_bin',
                'description' => 'Delete Diet',
                'status' => 1,
            ],

            // [
            //     'name' => 'Restore',
            //     'slug' => 'restore_admin',
            //     'module_name' => 'Restore',
            //     'module_slug' => 'recycle_bin_admins',
            //     'description' => 'desc',
            //     'status' => 1
            // ],
            // [
            //     'name' => 'Permanent Delete',
            //     'slug' => 'permanent_delete_admin',
            //     'module_name' => 'Permanent Delete',
            //     'module_slug' => 'recycle_bin_admins',
            //     'description' => 'desc',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'Restore',
            //     'slug' => 'restore_roles',
            //     'module_name' => 'Restore',
            //     'module_slug' => 'recycle_bin_roles',
            //     'description' => 'desc',
            //     'status' => 1
            // ],
            // [
            //     'name' => 'Permanent Delete',
            //     'slug' => 'permanent_delete_roles',
            //     'module_name' => 'Permanent Delete',
            //     'module_slug' => 'recycle_bin_roles',
            //     'description' => 'desc',
            //     'status' => 1
            // ],

            // [
            //     'name' => 'View',
            //     'slug' => 'view_feedbacks',
            //     'module_name' => 'Feedbacks',
            //     'module_slug' => 'feedbacks',
            //     'description' => 'desc',
            //     'status' => 1
            // ],
            // [
            //     'name' => 'View',
            //     'slug' => 'view_contactus',
            //     'module_name' => 'ContactUs',
            //     'module_slug' => 'contactus',
            //     'description' => 'desc',
            //     'status' => 1
            // ],
            // [
            //     'name' => 'Reply',
            //     'slug' => 'reply_contactus',
            //     'module_name' => 'ContactUs',
            //     'module_slug' => 'contactus',
            //     'description' => 'desc',
            //     'status' => 1
            // ],
        ]);

        $allPermissions = \DB::table('permissions')->get();
        for ($i = 0; $i < count($allPermissions); $i++) {
            $permission = $allPermissions[$i];
            \DB::table('permission_role')->insert([
                'permission_id' => $permission->id,
                'role_id' => 1,
            ]);
        }
    }
}
