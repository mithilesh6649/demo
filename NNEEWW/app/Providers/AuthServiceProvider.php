<?php

namespace App\Providers;

use Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Start Apply Gates
        Gate::define('manage_users_management', function ($user) {

            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_user' ||
                    $permissions[$i]->slug == 'edit_user' ||
                    $permissions[$i]->slug == 'delete_user' ||
                    $permissions[$i]->slug == 'add_user' ||
                    $permissions[$i]->slug == 'add_admin' ||
                    $permissions[$i]->slug == 'edit_admin' ||
                    $permissions[$i]->slug == 'view_admin' ||
                    $permissions[$i]->slug == 'delete_admin' ||
                    $permissions[$i]->slug == 'add_nutritionist' ||
                    $permissions[$i]->slug == 'delete_nutritionist' ||
                    $permissions[$i]->slug == 'edit_nutritionist' ||
                    $permissions[$i]->slug == 'view_nutritionist'||
                    $permissions[$i]->slug == 'view_subscribers'
                ) {
                    return true;
                }
            }
        });

        //USER

        //Customer Management
        Gate::define('user_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_user' ||
                    $permissions[$i]->slug == 'edit_user' ||
                    $permissions[$i]->slug == 'delete_user' ||
                    $permissions[$i]->slug == 'add_user'
                ) {
                    return true;
                }
            }
        });

        // users
        Gate::define('add_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_user') {
                    return true;
                }
            }
        });

        Gate::define('edit_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_user') {
                    return true;
                }
            }
        });

        Gate::define('delete_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_user') {
                    return true;
                }
            }
        });

        Gate::define('view_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_user') {
                    return true;
                }
            }
        });
        // users

        //Admin

        Gate::define('admin_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_admin' ||
                    $permissions[$i]->slug == 'edit_admin' ||
                    $permissions[$i]->slug == 'delete_admin' ||
                    $permissions[$i]->slug == 'add_admin'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_admin') {
                    return true;
                }
            }
        });

        Gate::define('edit_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_admin') {
                    return true;
                }
            }
        });

        Gate::define('delete_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_admin') {
                    return true;
                }
            }
        });

        Gate::define('view_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_admin') {
                    return true;
                }
            }
        });

        //Nutritionist

        Gate::define('nutritionist_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_nutritionist' ||
                    $permissions[$i]->slug == 'edit_nutritionist' ||
                    $permissions[$i]->slug == 'delete_nutritionist' ||
                    $permissions[$i]->slug == 'add_nutritionist'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_nutritionist', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_nutritionist') {
                    return true;
                }
            }
        });

        Gate::define('edit_nutritionist', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_nutritionist') {
                    return true;
                }
            }
        });

        Gate::define('delete_nutritionist', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_nutritionist') {
                    return true;
                }
            }
        });

        Gate::define('view_nutritionist', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_nutritionist') {
                    return true;
                }
            }
        });

           // users
        Gate::define('view_subscribers', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_subscribers') {
                    return true;
                }
            }
        });
        //APPOINTMENTS

        Gate::define('appointments_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_appointments' ||
                    $permissions[$i]->slug == 'edit_appointments' ||
                    $permissions[$i]->slug == 'delete_appointments' ||
                    $permissions[$i]->slug == 'add_appointments'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_appointments', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_appointments') {
                    return true;
                }
            }
        });

        Gate::define('edit_appointments', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_appointments') {
                    return true;
                }
            }
        });

        Gate::define('delete_appointments', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_appointments') {
                    return true;
                }
            }
        });

        Gate::define('view_appointments', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_appointments') {
                    return true;
                }
            }
        });




          //Genetic Test

        Gate::define('genetic_test_reports_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'upload_test_reports' ||
                    $permissions[$i]->slug == 'view_test_reports'  
                ) {
                    return true;
                }
            }
        });

        Gate::define('upload_test_reports', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'upload_test_reports') {
                    return true;
                }
            }
        });

        Gate::define('view_test_reports', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_test_reports') {
                    return true;
                }
            }
        });

        


        //Consultation Session

        Gate::define('consultation_session_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_consultation_session' ||
                    $permissions[$i]->slug == 'delete_consultation_session'

                ) {
                    return true;
                }
            }
        });

        Gate::define('view_consultation_session', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_consultation_session') {
                    return true;
                }
            }
        });

        Gate::define('delete_consultation_session', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_consultation_session') {
                    return true;
                }
            }
        });

        //Referral Patients

        Gate::define('referral_patients_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_referral_patients' ||
                    $permissions[$i]->slug == 'delete_referral_patients'

                ) {
                    return true;
                }
            }
        });

        Gate::define('view_referral_patients', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_referral_patients') {
                    return true;
                }
            }
        });

        Gate::define('delete_referral_patients', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_referral_patients') {
                    return true;
                }
            }
        });

        //Diet Management

        // Start Apply Gates
        Gate::define('manage_diets_management', function ($user) {

            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_diet_category' ||
                    $permissions[$i]->slug == 'edit_diet_category' ||
                    $permissions[$i]->slug == 'delete_diet_category' ||
                    $permissions[$i]->slug == 'add_diet_category' ||
                    $permissions[$i]->slug == 'add_diet' ||
                    $permissions[$i]->slug == 'edit_diet' ||
                    $permissions[$i]->slug == 'view_diet' ||
                    $permissions[$i]->slug == 'delete_diet'

                ) {
                    return true;
                }
            }
        });

        //USER

        //diet_category Management
        Gate::define('diet_category_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (

                    $permissions[$i]->slug == 'view_diet_subscription_plans' ||
                    $permissions[$i]->slug == 'edit_diet_subscription_plans' ||
                    $permissions[$i]->slug == 'view_diet_category' ||
                    $permissions[$i]->slug == 'edit_diet_category' ||
                    $permissions[$i]->slug == 'delete_diet_category' ||
                    $permissions[$i]->slug == 'add_diet_category'
                ) {
                    return true;
                }
            }
        });

        // users
        Gate::define('add_diet_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_diet_category') {
                    return true;
                }
            }
        });

        Gate::define('edit_diet_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_diet_category') {
                    return true;
                }
            }
        });

        Gate::define('delete_diet_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_diet_category') {
                    return true;
                }
            }
        });

        Gate::define('view_diet_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_diet_category') {
                    return true;
                }
            }
        });
        // users

        //Admin

        Gate::define('diet_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_diet' ||
                    $permissions[$i]->slug == 'edit_diet' ||
                    $permissions[$i]->slug == 'delete_diet' ||
                    $permissions[$i]->slug == 'add_diet'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_diet', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_diet') {
                    return true;
                }
            }
        });

        Gate::define('edit_diet', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_diet') {
                    return true;
                }
            }
        });

        Gate::define('delete_diet', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_diet') {
                    return true;
                }
            }
        });

        Gate::define('view_diet', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_diet') {
                    return true;
                }
            }
        });

        //Consultations

        Gate::define('diet_subscription_plans_manage', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'edit_diet_subscription_plans' ||
                    $permissions[$i]->slug == 'view_diet_subscription_plans'

                ) {
                    return true;
                }
            }
        });

        Gate::define('edit_diet_subscription_plans', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_diet_subscription_plans') {
                    return true;
                }
            }
        });

        Gate::define('view_diet_subscription_plans', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_diet_subscription_plans') {
                    return true;
                }
            }
        });

        //Nutritionist

        //contact_us Management

        // Start Apply Gates
        Gate::define('manage_user_feedback_management', function ($user) {

            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'edit_help_and_support' ||
                    $permissions[$i]->slug == 'view_help_and_support' ||
                    $permissions[$i]->slug == 'view_review' ||
                    $permissions[$i]->slug == 'edit_review' ||
                    $permissions[$i]->slug == 'delete_review' ||
                    $permissions[$i]->slug == 'add_review' ||
                    $permissions[$i]->slug == 'edit_contact_us' ||
                    $permissions[$i]->slug == 'view_contact_us' ||
                    $permissions[$i]->slug == 'reply_contact_us' 


                ) {
                    return true;
                }
            }
        });

        //USER



        //review Management
        Gate::define('review_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_review' ||
                    $permissions[$i]->slug == 'edit_review' ||
                    $permissions[$i]->slug == 'delete_review' ||
                    $permissions[$i]->slug == 'add_review'
                ) {
                    return true;
                }
            }
        });

        // users
        Gate::define('add_review', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_review') {
                    return true;
                }
            }
        });

        Gate::define('edit_review', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_review') {
                    return true;
                }
            }
        });

        Gate::define('delete_review', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_review') {
                    return true;
                }
            }
        });

        Gate::define('view_review', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_review') {
                    return true;
                }
            }
        });
        // users

        //Admin

        Gate::define('contact_us_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_contact_us' ||
                    $permissions[$i]->slug == 'edit_contact_us' ||
                    $permissions[$i]->slug == 'reply_contact_us'

                ) {
                    return true;
                }
            }
        });

        Gate::define('edit_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_contact_us') {
                    return true;
                }
            }
        });

        Gate::define('reply_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'reply_contact_us') {
                    return true;
                }
            }
        });

        Gate::define('view_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_contact_us') {
                    return true;
                }
            }
        });

       //Help & Support


        Gate::define('help_and_support_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_help_and_support' ||
                    $permissions[$i]->slug == 'edit_help_and_support'  

                ) {
                    return true;
                }
            }
        });

        Gate::define('view_help_and_support', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_help_and_support') {
                    return true;
                }
            }
        });

        Gate::define('edit_help_and_support', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_help_and_support') {
                    return true;
                }
            }
        });


        //Nutritionist


         // users
        Gate::define('view_payment_transactions', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_payment_transactions') {
                    return true;
                }
            }
        });

        //CONTENT MANAGEMENT

        // Start Apply Gates
        Gate::define('manage_content_management', function ($user) {

            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_media' ||
                    $permissions[$i]->slug == 'edit_media' ||
                    $permissions[$i]->slug == 'delete_media' ||
                    $permissions[$i]->slug == 'add_media' ||
                    $permissions[$i]->slug == 'add_website' ||
                    $permissions[$i]->slug == 'edit_website' ||
                    $permissions[$i]->slug == 'view_website' ||
                    $permissions[$i]->slug == 'add_mobile' ||
                    $permissions[$i]->slug == 'edit_mobile' ||
                    $permissions[$i]->slug == 'view_mobile' ||
                    $permissions[$i]->slug == 'delete_website' ||
                    $permissions[$i]->slug == 'add_social_links' ||
                    $permissions[$i]->slug == 'delete_social_links' ||
                    $permissions[$i]->slug == 'edit_social_links' ||
                    $permissions[$i]->slug == 'view_social_links'
                ) {
                    return true;
                }
            }
        });

        //USER

        //Customer Management
        Gate::define('media_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_media' ||
                    $permissions[$i]->slug == 'edit_media' ||
                    $permissions[$i]->slug == 'delete_media' ||
                    $permissions[$i]->slug == 'add_media'
                ) {
                    return true;
                }
            }
        });

        // users
        Gate::define('add_media', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_media') {
                    return true;
                }
            }
        });

        Gate::define('edit_media', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_media') {
                    return true;
                }
            }
        });

        Gate::define('delete_media', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_media') {
                    return true;
                }
            }
        });

        Gate::define('view_media', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_media') {
                    return true;
                }
            }
        });
        // users

        //Admin

        Gate::define('website_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_website' ||
                    $permissions[$i]->slug == 'edit_website' ||
                    $permissions[$i]->slug == 'delete_website' ||
                    $permissions[$i]->slug == 'add_website'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_website', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_website') {
                    return true;
                }
            }
        });

        Gate::define('edit_website', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_website') {
                    return true;
                }
            }
        });

        Gate::define('delete_website', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_website') {
                    return true;
                }
            }
        });

        Gate::define('view_website', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_website') {
                    return true;
                }
            }
        });

        //Admin

        Gate::define('mobile_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_mobile' ||
                    $permissions[$i]->slug == 'edit_mobile' ||
                    $permissions[$i]->slug == 'delete_mobile' ||
                    $permissions[$i]->slug == 'add_mobile'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_mobile', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_mobile') {
                    return true;
                }
            }
        });

        Gate::define('edit_mobile', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_mobile') {
                    return true;
                }
            }
        });

        Gate::define('delete_mobile', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_mobile') {
                    return true;
                }
            }
        });

        Gate::define('view_mobile', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_mobile') {
                    return true;
                }
            }
        });

        //Nutritionist

        Gate::define('social_links_management', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'view_social_links' ||
                    $permissions[$i]->slug == 'edit_social_links' ||
                    $permissions[$i]->slug == 'delete_social_links' ||
                    $permissions[$i]->slug == 'add_social_links'
                ) {
                    return true;
                }
            }
        });

        Gate::define('add_social_links', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'add_social_links') {
                    return true;
                }
            }
        });

        Gate::define('edit_social_links', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'edit_social_links') {
                    return true;
                }
            }
        });

        Gate::define('delete_social_links', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'delete_social_links') {
                    return true;
                }
            }
        });

        Gate::define('view_social_links', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if ($permissions[$i]->slug == 'view_social_links') {
                    return true;
                }
            }
        });

        //MISC DATA MANAGEMENT

        // Start Apply Gates
        Gate::define('manage_misc_data_management', function ($user) {

            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i = 0; $i < count($permissions); $i++) {
                if (
                    $permissions[$i]->slug == 'add_blog' ||
                    $permissions[$i]->slug == 'delete_blog' ||
                    $permissions[$i]->slug == 'edit_blog' ||
                    $permissions[$i]->slug == 'view_blog' ||

                    $permissions[$i]->slug == 'view_laboratories' ||
                    $permissions[$i]->slug == 'edit_laboratories' ||
                    $permissions[$i]->slug == 'delete_laboratories' ||
                    $permissions[$i]->slug == 'add_laboratories'||

                    $permissions[$i]->slug == 'view_referral_patients' ||
                    $permissions[$i]->slug == 'delete_referral_patients'||

                    

                    $permissions[$i]->slug == 'add_specialization' ||
                    $permissions[$i]->slug == 'edit_specialization' ||
                    $permissions[$i]->slug == 'view_specialization' ||
                    $permissions[$i]->slug == 'delete_specialization' ||
                    

                    $permissions[$i]->slug == 'view_subscription_plans' ||
                    $permissions[$i]->slug == 'edit_subscription_plans' ||
                    $permissions[$i]->slug == 'delete_subscription_plans' ||
                    $permissions[$i]->slug == 'add_subscription_plans' ||

                     // Is called healtcomplaint
                    $permissions[$i]->slug == 'add_project_features' ||
                    $permissions[$i]->slug == 'delete_project_features' ||
                    $permissions[$i]->slug == 'edit_project_features' ||
                    $permissions[$i]->slug == 'view_project_features' ||

                    $permissions[$i]->slug == 'add_our_team' ||
                    $permissions[$i]->slug == 'delete_our_team' ||
                    $permissions[$i]->slug == 'edit_our_team' ||
                    $permissions[$i]->slug == 'view_our_team' ||

                    $permissions[$i]->slug == 'add_test' ||
                    $permissions[$i]->slug == 'delete_test' ||
                    $permissions[$i]->slug == 'edit_test' ||
                    $permissions[$i]->slug == 'view_test' ||
                    $permissions[$i]->slug == 'edit_additional_test_discount' ||
                    $permissions[$i]->slug == 'view_additional_test_discount' ||

                    $permissions[$i]->slug == 'edit_consultations' ||
                    $permissions[$i]->slug == 'view_consultations' ||


                    $permissions[$i]->slug == 'add_job' ||
                    $permissions[$i]->slug == 'edit_job' ||
                    $permissions[$i]->slug == 'view_job' ||
                    $permissions[$i]->slug == 'delete_job' ||
                    
                    $permissions[$i]->slug == 'view_meal_template' ||

                    $permissions[$i]->slug == 'add_exercises' ||
                    $permissions[$i]->slug == 'edit_exercises' ||
                    $permissions[$i]->slug == 'view_exercises' ||
                    $permissions[$i]->slug == 'delete_exercises' ||

                    $permissions[$i]->slug == 'add_food' ||
                    $permissions[$i]->slug == 'edit_food' ||
                    $permissions[$i]->slug == 'view_food' ||
                    $permissions[$i]->slug == 'delete_food' ||

                    $permissions[$i]->slug == 'add_rda' ||
                    $permissions[$i]->slug == 'edit_rda' ||
                    $permissions[$i]->slug == 'view_rda' ||
                    $permissions[$i]->slug == 'delete_rda' ||

                    $permissions[$i]->slug == 'add_trait_category' ||
                    $permissions[$i]->slug == 'edit_trait_category' ||
                    $permissions[$i]->slug == 'view_trait_category' ||
                    $permissions[$i]->slug == 'delete_trait_category' ||
                    
                    $permissions[$i]->slug == 'add_trait' ||
                    $permissions[$i]->slug == 'edit_trait' ||
                    $permissions[$i]->slug == 'view_trait' ||
                    $permissions[$i]->slug == 'delete_trait' ||
                    


                    $permissions[$i]->slug == 'view_diseases' ||
                    $permissions[$i]->slug == 'edit_diseases' ||
                    $permissions[$i]->slug == 'delete_diseases' ||
                    $permissions[$i]->slug == 'add_diseases' ||

                    $permissions[$i]->slug == 'add_allergies' ||
                    $permissions[$i]->slug == 'edit_allergies' ||
                    $permissions[$i]->slug == 'view_allergies' ||
                    $permissions[$i]->slug == 'delete_allergies' ||

                    $permissions[$i]->slug == 'view_recipe_category' ||
                    $permissions[$i]->slug == 'edit_recipe_category' ||
                    $permissions[$i]->slug == 'delete_recipe_category' ||
                    $permissions[$i]->slug == 'add_recipe_category' ||

                    $permissions[$i]->slug == 'add_recipe' ||
                    $permissions[$i]->slug == 'edit_recipe' ||
                    $permissions[$i]->slug == 'view_recipe' ||
                    $permissions[$i]->slug == 'delete_recipe' ||

                    $permissions[$i]->slug == 'edit_diet_subscription_plans' ||
                    $permissions[$i]->slug == 'view_diet_subscription_plans' ||

                    $permissions[$i]->slug == 'view_diet_category' ||
                    $permissions[$i]->slug == 'edit_diet_category' ||
                    $permissions[$i]->slug == 'delete_diet_category' ||
                    $permissions[$i]->slug == 'add_diet_category' ||
                    $permissions[$i]->slug == 'add_diet' ||
                    $permissions[$i]->slug == 'edit_diet' ||
                    $permissions[$i]->slug == 'view_diet' ||
                    $permissions[$i]->slug == 'delete_diet'

                ) {
    return true;
}
}
});


         //Blog Management

Gate::define('blog_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_blog' ||
            $permissions[$i]->slug == 'edit_blog' ||
            $permissions[$i]->slug == 'delete_blog' ||
            $permissions[$i]->slug == 'add_blog'
        ) {
            return true;
        }
    }
});

Gate::define('add_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_blog') {
            return true;
        }
    }
});

Gate::define('edit_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_blog') {
            return true;
        }
    }
});



Gate::define('delete_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_blog') {
            return true;
        }
    }
});

Gate::define('view_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_blog') {
            return true;
        }
    }
});


         //LABORATORIES 



Gate::define('laboratories_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_laboratories' ||
            $permissions[$i]->slug == 'edit_laboratories' ||
            $permissions[$i]->slug == 'delete_laboratories' ||
            $permissions[$i]->slug == 'add_laboratories'
        ) {
            return true;
        }
    }
});

Gate::define('add_laboratories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_laboratories') {
            return true;
        }
    }
});

Gate::define('edit_laboratories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_laboratories') {
            return true;
        }
    }
});

Gate::define('delete_laboratories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_laboratories') {
            return true;
        }
    }
});

Gate::define('view_laboratories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_laboratories') {
            return true;
        }
    }
});






      //Specializations

Gate::define('specialization_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_specialization' ||
            $permissions[$i]->slug == 'edit_specialization' ||
            $permissions[$i]->slug == 'delete_specialization' ||
            $permissions[$i]->slug == 'add_specialization'
        ) {
            return true;
        }
    }
});

Gate::define('add_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_specialization') {
            return true;
        }
    }
});

Gate::define('edit_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_specialization') {
            return true;
        }
    }
});

Gate::define('delete_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_specialization') {
            return true;
        }
    }
});

Gate::define('view_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_specialization') {
            return true;
        }
    }
});

        //Customer Management
Gate::define('subscription_plans_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_subscription_plans' ||
            $permissions[$i]->slug == 'edit_subscription_plans' ||
            $permissions[$i]->slug == 'delete_subscription_plans' ||
            $permissions[$i]->slug == 'add_subscription_plans'
        ) {
            return true;
        }
    }
});

        // users
Gate::define('add_subscription_plans', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_subscription_plans') {
            return true;
        }
    }
});

Gate::define('edit_subscription_plans', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_subscription_plans') {
            return true;
        }
    }
});

Gate::define('delete_subscription_plans', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_subscription_plans') {
            return true;
        }
    }
});

Gate::define('view_subscription_plans', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_subscription_plans') {
            return true;
        }
    }
});
        // users




Gate::define('view_meal_template', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_meal_template') {
            return true;
        }
    }
});




           //Job

Gate::define('job_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_job' ||
            $permissions[$i]->slug == 'edit_job' ||
            $permissions[$i]->slug == 'delete_job' ||
            $permissions[$i]->slug == 'add_job'
        ) {
            return true;
        }
    }
});

Gate::define('add_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_job') {
            return true;
        }
    }
});

Gate::define('edit_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_job') {
            return true;
        }
    }
});

Gate::define('delete_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_job') {
            return true;
        }
    }
});

Gate::define('view_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_job') {
            return true;
        }
    }
});


           //exercises

Gate::define('exercises_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_exercises' ||
            $permissions[$i]->slug == 'edit_exercises' ||
            $permissions[$i]->slug == 'delete_exercises' ||
            $permissions[$i]->slug == 'add_exercises'
        ) {
            return true;
        }
    }
});

Gate::define('add_exercises', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_exercises') {
            return true;
        }
    }
});

Gate::define('edit_exercises', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_exercises') {
            return true;
        }
    }
});

Gate::define('delete_exercises', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_exercises') {
            return true;
        }
    }
});

Gate::define('view_exercises', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_exercises') {
            return true;
        }
    }
});




 //Foods

Gate::define('foods_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_food' ||
            $permissions[$i]->slug == 'edit_food' ||
            $permissions[$i]->slug == 'delete_food' ||
            $permissions[$i]->slug == 'add_food'
        ) {
            return true;
        }
    }
});

Gate::define('add_food', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_food') {
            return true;
        }
    }
});

Gate::define('edit_food', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_food') {
            return true;
        }
    }
});

Gate::define('delete_food', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_food') {
            return true;
        }
    }
});

Gate::define('view_food', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_food') {
            return true;
        }
    }
});



 //RDA

Gate::define('rda_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_rda' ||
            $permissions[$i]->slug == 'edit_rda' ||
            $permissions[$i]->slug == 'delete_rda' ||
            $permissions[$i]->slug == 'add_rda'
        ) {
            return true;
        }
    }
});

Gate::define('add_rda', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_rda') {
            return true;
        }
    }
});

Gate::define('edit_rda', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_rda') {
            return true;
        }
    }
});

Gate::define('delete_rda', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_rda') {
            return true;
        }
    }
});

Gate::define('view_rda', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_rda') {
            return true;
        }
    }
});




Gate::define('trait_its_category_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_trait_category' ||
            $permissions[$i]->slug == 'edit_trait_category' ||
            $permissions[$i]->slug == 'delete_trait_category' ||
            $permissions[$i]->slug == 'add_trait_category'
        ) {
            return true;
        }
    }
});

 //Traits Categories

Gate::define('trait_category_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_trait_category' ||
            $permissions[$i]->slug == 'edit_trait_category' ||
            $permissions[$i]->slug == 'delete_trait_category' ||
            $permissions[$i]->slug == 'add_trait_category'||
            $permissions[$i]->slug == 'view_trait' ||
            $permissions[$i]->slug == 'edit_trait' ||
            $permissions[$i]->slug == 'delete_trait' ||
            $permissions[$i]->slug == 'add_trait'
        ) {
            return true;
        }
    }
});

Gate::define('add_trait_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_trait_category') {
            return true;
        }
    }
});

Gate::define('edit_trait_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_trait_category') {
            return true;
        }
    }
});

Gate::define('delete_trait_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_trait_category') {
            return true;
        }
    }
});

Gate::define('view_trait_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_trait_category') {
            return true;
        }
    }
});



 //Traits 

Gate::define('trait_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_trait' ||
            $permissions[$i]->slug == 'edit_trait' ||
            $permissions[$i]->slug == 'delete_trait' ||
            $permissions[$i]->slug == 'add_trait'
        ) {
            return true;
        }
    }
});

Gate::define('add_trait', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_trait') {
            return true;
        }
    }
});

Gate::define('edit_trait', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_trait') {
            return true;
        }
    }
});

Gate::define('delete_trait', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_trait') {
            return true;
        }
    }
});

Gate::define('view_trait', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_trait') {
            return true;
        }
    }
});


        //Nutritionist

Gate::define('project_features_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_project_features' ||
            $permissions[$i]->slug == 'edit_project_features' ||
            $permissions[$i]->slug == 'delete_project_features' ||
            $permissions[$i]->slug == 'add_project_features'
        ) {
            return true;
        }
    }
});

Gate::define('add_project_features', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_project_features') {
            return true;
        }
    }
});

Gate::define('edit_project_features', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_project_features') {
            return true;
        }
    }
});

Gate::define('delete_project_features', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_project_features') {
            return true;
        }
    }
});

Gate::define('view_project_features', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_project_features') {
            return true;
        }
    }
});

Gate::define('our_team_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_our_team' ||
            $permissions[$i]->slug == 'edit_our_team' ||
            $permissions[$i]->slug == 'delete_our_team' ||
            $permissions[$i]->slug == 'add_our_team'
        ) {
            return true;
        }
    }
});

Gate::define('add_our_team', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_our_team') {
            return true;
        }
    }
});

Gate::define('edit_our_team', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_our_team') {
            return true;
        }
    }
});

Gate::define('delete_our_team', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_our_team') {
            return true;
        }
    }
});

Gate::define('view_our_team', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_our_team') {
            return true;
        }
    }
});



        //Test Management

Gate::define('test_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_test' ||
            $permissions[$i]->slug == 'edit_test' ||
            $permissions[$i]->slug == 'delete_test' ||
            $permissions[$i]->slug == 'add_test' ||
            $permissions[$i]->slug == 'edit_additional_test_discount' ||
            $permissions[$i]->slug == 'view_additional_test_discount'

        ) {
            return true;
        }
    }
});

Gate::define('additional_test_discount_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (

            $permissions[$i]->slug == 'edit_additional_test_discount' ||
            $permissions[$i]->slug == 'view_additional_test_discount'

        ) {
            return true;
        }
    }
});

Gate::define('edit_additional_test_discount', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_additional_test_discount') {
            return true;
        }
    }
});

Gate::define('view_additional_test_discount', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_additional_test_discount') {
            return true;
        }
    }
});

Gate::define('add_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_test') {
            return true;
        }
    }
});

Gate::define('edit_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_test') {
            return true;
        }
    }
});

Gate::define('delete_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_test') {
            return true;
        }
    }
});

Gate::define('view_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_test') {
            return true;
        }
    }
});

        //Consultations

Gate::define('consultations_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'edit_consultations' ||
            $permissions[$i]->slug == 'view_consultations'

        ) {
            return true;
        }
    }
});

Gate::define('edit_consultations', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_consultations') {
            return true;
        }
    }
});

Gate::define('view_consultations', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_consultations') {
            return true;
        }
    }
});

        // Start Apply Gates
Gate::define('manage_health_complaint_management', function ($user) {

    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_diseases' ||
            $permissions[$i]->slug == 'edit_diseases' ||
            $permissions[$i]->slug == 'delete_diseases' ||
            $permissions[$i]->slug == 'add_diseases' ||
            $permissions[$i]->slug == 'add_allergies' ||
            $permissions[$i]->slug == 'edit_allergies' ||
            $permissions[$i]->slug == 'view_allergies' ||
            $permissions[$i]->slug == 'delete_allergies'

        ) {
            return true;
        }
    }
});

        //Customer Management
Gate::define('diseases_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_diseases' ||
            $permissions[$i]->slug == 'edit_diseases' ||
            $permissions[$i]->slug == 'delete_diseases' ||
            $permissions[$i]->slug == 'add_diseases'
        ) {
            return true;
        }
    }
});

        // users
Gate::define('add_diseases', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_diseases') {
            return true;
        }
    }
});

Gate::define('edit_diseases', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_diseases') {
            return true;
        }
    }
});

Gate::define('delete_diseases', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_diseases') {
            return true;
        }
    }
});

Gate::define('view_diseases', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_diseases') {
            return true;
        }
    }
});
        // users

        //Admin

Gate::define('allergies_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_allergies' ||
            $permissions[$i]->slug == 'edit_allergies' ||
            $permissions[$i]->slug == 'delete_allergies' ||
            $permissions[$i]->slug == 'add_allergies'
        ) {
            return true;
        }
    }
});

Gate::define('add_allergies', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_allergies') {
            return true;
        }
    }
});

Gate::define('edit_allergies', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_allergies') {
            return true;
        }
    }
});

Gate::define('delete_allergies', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_allergies') {
            return true;
        }
    }
});

Gate::define('view_allergies', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_allergies') {
            return true;
        }
    }
});

        // Start Apply Gates
Gate::define('manage_recipes_management', function ($user) {

    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_recipe_category' ||
            $permissions[$i]->slug == 'edit_recipe_category' ||
            $permissions[$i]->slug == 'delete_recipe_category' ||
            $permissions[$i]->slug == 'add_recipe_category' ||
            $permissions[$i]->slug == 'add_recipe' ||
            $permissions[$i]->slug == 'edit_recipe' ||
            $permissions[$i]->slug == 'view_recipe' ||
            $permissions[$i]->slug == 'delete_recipe'

        ) {
            return true;
        }
    }
});

        //USER

        //recipe_category Management
Gate::define('recipe_category_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_recipe_category' ||
            $permissions[$i]->slug == 'edit_recipe_category' ||
            $permissions[$i]->slug == 'delete_recipe_category' ||
            $permissions[$i]->slug == 'add_recipe_category'
        ) {
            return true;
        }
    }
});

        // users
Gate::define('add_recipe_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_recipe_category') {
            return true;
        }
    }
});

Gate::define('edit_recipe_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_recipe_category') {
            return true;
        }
    }
});

Gate::define('delete_recipe_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_recipe_category') {
            return true;
        }
    }
});

Gate::define('view_recipe_category', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_recipe_category') {
            return true;
        }
    }
});
        // users

        //Admin

Gate::define('recipe_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_recipe' ||
            $permissions[$i]->slug == 'edit_recipe' ||
            $permissions[$i]->slug == 'delete_recipe' ||
            $permissions[$i]->slug == 'add_recipe'
        ) {
            return true;
        }
    }
});

Gate::define('add_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_recipe') {
            return true;
        }
    }
});

Gate::define('edit_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_recipe') {
            return true;
        }
    }
});

Gate::define('delete_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_recipe') {
            return true;
        }
    }
});

Gate::define('view_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_recipe') {
            return true;
        }
    }
});

        //Recipe end

Gate::define('manage_setting_management', function ($user) {

    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_api_keys' ||
            $permissions[$i]->slug == 'edit_api_keys' ||
            $permissions[$i]->slug == 'add_notification' ||
            $permissions[$i]->slug == 'edit_notification' ||
            $permissions[$i]->slug == 'view_notification'
        ) {
            return true;
        }
    }
});

Gate::define('api_keys_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_api_keys' ||
            $permissions[$i]->slug == 'edit_api_keys'

        ) {
            return true;
        }
    }
});

Gate::define('edit_api_keys', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_api_keys') {
            return true;
        }
    }
});

Gate::define('view_api_keys', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_api_keys') {
            return true;
        }
    }
});

Gate::define('notification_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_notification' ||
            $permissions[$i]->slug == 'edit_notification' ||
            $permissions[$i]->slug == 'delete_notification' ||
            $permissions[$i]->slug == 'add_notification'
        ) {
            return true;
        }
    }
});

Gate::define('add_notification', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_notification') {
            return true;
        }
    }
});

Gate::define('edit_notification', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_notification') {
            return true;
        }
    }
});

Gate::define('delete_notification', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_notification') {
            return true;
        }
    }
});

Gate::define('view_notification', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_notification') {
            return true;
        }
    }
});

        //////////////////////////////////////////////////////////

        //Manage Access Control

Gate::define('manage_access_control_roles', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'add_role' ||
            $permissions[$i]->slug == 'view_role' ||
            $permissions[$i]->slug == 'edit_role' ||
            $permissions[$i]->slug == 'delete_role' ||
            $permissions[$i]->slug == 'view_permissions' ||
            $permissions[$i]->slug == 'edit_permissions'

        ) {
            return true;
        }
    }
});

Gate::define('manage_roles', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_role' ||
            $permissions[$i]->slug == 'view_role' ||
            $permissions[$i]->slug == 'edit_role' ||
            $permissions[$i]->slug == 'delete_role'

        ) {
            return true;
    }
}
});

Gate::define('add_role', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'add_role'

    ) {
            return true;
    }
}
});

Gate::define('edit_role', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_role'

    ) {
            return true;
    }
}
});

Gate::define('view_role', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_role'

    ) {
            return true;
    }
}
});

Gate::define('delete_role', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'delete_role'

    ) {
            return true;
    }
}
});

Gate::define('manage_permissions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_permissions' ||
            $permissions[$i]->slug == 'edit_permissions'

        ) {
            return true;
    }
}
});

Gate::define('view_permissions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_permissions'

    ) {
            return true;
    }
}
});

Gate::define('edit_permissions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'edit_permissions'

    ) {
            return true;
    }
}
});

// Gate::define('add_role', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'add_role') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('edit_role', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'edit_role') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('view_role', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'view_role') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('delete_role', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'delete_role') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('add_permissions', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'add_permissions') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('restore_admin', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'restore_admin') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('permanent_delete_admin', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'permanent_delete_admin') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('restore_users', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'restore_users') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('permanent_delete_users', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'permanent_delete_users') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('restore_roles', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'restore_roles') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('permanent_delete_roles', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'permanent_delete_roles') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('edit_mobile_page', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'edit_mobile_page') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('view_mobile_page', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'view_mobile_page') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('view_feedbacks', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'view_feedbacks') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('view_contactus', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'view_contactus') {
        //             return true;
        //         }
        //     }
        // });

// Gate::define('reply_contactus', function ($user) {
        //     $user = Auth::user();
        //     $permissions = $user->role->permissions;
        //     for ($i = 0; $i < count($permissions); $i++) {
        //         if ($permissions[$i]->slug == 'reply_contactus') {
        //             return true;
        //         }
        //     }
        // });

        //For Recycle Bin Module...........

Gate::define('manage_recycle_bin_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_user' ||
            $permissions[$i]->slug == 'restore_user' ||
            $permissions[$i]->slug == 'permanent_deleted_user' ||
            $permissions[$i]->slug == 'view_deleted_nutrionists' ||
            $permissions[$i]->slug == 'restore_nutrionists' ||
            $permissions[$i]->slug == 'permanent_deleted_nutrionists' ||
            $permissions[$i]->slug == 'view_deleted_admin' ||
            $permissions[$i]->slug == 'restore_admin' ||
            $permissions[$i]->slug == 'permanent_deleted_admin' ||
            $permissions[$i]->slug == 'view_deleted_laboratory' ||
            $permissions[$i]->slug == 'restore_laboratory' ||
            $permissions[$i]->slug == 'permanent_deleted_laboratory' ||
            $permissions[$i]->slug == 'view_deleted_consultant_sessions' ||
            $permissions[$i]->slug == 'restore_consultant_sessions' ||
            $permissions[$i]->slug == 'permanent_deleted_consultant_sessions' ||
            $permissions[$i]->slug == 'view_deleted_clinicians' ||
            $permissions[$i]->slug == 'restore_clinicians' ||
            $permissions[$i]->slug == 'permanent_deleted_clinicians' ||
            $permissions[$i]->slug == 'view_deleted_testimonials' ||
            $permissions[$i]->slug == 'restore_testimonials' ||
            $permissions[$i]->slug == 'permanent_deleted_testimonials' ||
            $permissions[$i]->slug == 'view_deleted_social_links' ||
            $permissions[$i]->slug == 'restore_social_links' ||
            $permissions[$i]->slug == 'permanent_deleted_social_links' ||
            $permissions[$i]->slug == 'view_deleted_blog' ||
            $permissions[$i]->slug == 'restore_blog' ||
            $permissions[$i]->slug == 'permanent_deleted_blog' ||
            $permissions[$i]->slug == 'view_deleted_specialization' ||
            $permissions[$i]->slug == 'restore_specialization' ||
            $permissions[$i]->slug == 'permanent_deleted_specialization' ||
            $permissions[$i]->slug == 'view_deleted_health_complaints' ||
            $permissions[$i]->slug == 'restore_health_complaints' ||
            $permissions[$i]->slug == 'permanent_deleted_health_complaints' ||
            $permissions[$i]->slug == 'view_deleted_our_teams' ||
            $permissions[$i]->slug == 'restore_our_teams' ||
            $permissions[$i]->slug == 'permanent_deleted_our_teams' ||
            $permissions[$i]->slug == 'view_deleted_test' ||
            $permissions[$i]->slug == 'restore_test' ||
            $permissions[$i]->slug == 'permanent_deleted_test' ||

            $permissions[$i]->slug == 'view_deleted_job' ||
            $permissions[$i]->slug == 'restore_job' ||
            $permissions[$i]->slug == 'permanent_deleted_job' ||


            $permissions[$i]->slug == 'view_deleted_exercise' ||
            $permissions[$i]->slug == 'restore_exercise' ||
            $permissions[$i]->slug == 'permanent_deleted_exercise' ||


            $permissions[$i]->slug == 'view_deleted_recipe_categories' ||
            $permissions[$i]->slug == 'restore_recipe_categories' ||
            $permissions[$i]->slug == 'permanent_deleted_recipe_categories' ||
            $permissions[$i]->slug == 'view_deleted_recipe' ||
            $permissions[$i]->slug == 'restore_recipe' ||
            $permissions[$i]->slug == 'permanent_deleted_recipe' ||
            $permissions[$i]->slug == 'view_deleted_diet_categories' ||
            $permissions[$i]->slug == 'restore_diet_categories' ||
            $permissions[$i]->slug == 'permanent_delete_diet_categories' ||
            $permissions[$i]->slug == 'view_deleted_diet' ||
            $permissions[$i]->slug == 'restore_diet' ||
            $permissions[$i]->slug == 'permanent_deleted_diet'

        ) {
            return true;
        }
    }
});


     //Clinicians  Management Tab

Gate::define('manage_recyle_clinicians_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (

            $permissions[$i]->slug == 'view_deleted_clinicians' ||
            $permissions[$i]->slug == 'restore_clinicians' ||
            $permissions[$i]->slug == 'permanent_deleted_clinicians'
        ) {
            return true;
        }
    }
});


Gate::define('view_deleted_clinicians', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_clinicians'

    ) {
            return true;
    }
}
});

Gate::define('restore_clinicians', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_clinicians'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_clinicians', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_clinicians'

    ) {
            return true;
    }
}
});

Gate::define('manage_recycle_bin_user_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_user' ||
            $permissions[$i]->slug == 'restore_user' ||
            $permissions[$i]->slug == 'permanent_deleted_user' ||
            $permissions[$i]->slug == 'view_deleted_nutrionists' ||
            $permissions[$i]->slug == 'restore_nutrionists' ||
            $permissions[$i]->slug == 'permanent_deleted_nutrionists' ||
            $permissions[$i]->slug == 'view_deleted_admin' ||
            $permissions[$i]->slug == 'restore_admin' ||
            $permissions[$i]->slug == 'permanent_deleted_admin'

        ) {
            return true;
        }
    }
});

        //Recyle customer

        //User Management Tab

Gate::define('manage_recyle_user_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_user' ||
            $permissions[$i]->slug == 'restore_user' ||
            $permissions[$i]->slug == 'permanent_deleted_user'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_user', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_user'

    ) {
            return true;
    }
}
});

Gate::define('restore_user', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_user'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_user', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_user'

    ) {
            return true;
    }
}
});

        //Recyle Admin

        //Nutrionists Management Tab

Gate::define('manage_recyle_nutrionists_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_nutrionists' ||
            $permissions[$i]->slug == 'restore_nutrionists' ||
            $permissions[$i]->slug == 'permanent_deleted_nutrionists'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_nutrionists', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_nutrionists'

    ) {
            return true;
    }
}
});

Gate::define('restore_nutrionists', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_nutrionists'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_nutrionists', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_nutrionists'

    ) {
            return true;
    }
}
});

        //Admin Management Tab

Gate::define('manage_recyle_admin_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_admin' ||
            $permissions[$i]->slug == 'restore_admin' ||
            $permissions[$i]->slug == 'permanent_deleted_admin'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_admin', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_admin'

    ) {
            return true;
    }
}
});

Gate::define('restore_admin', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_admin'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_admin', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_admin'

    ) {
            return true;
    }
}
});

        //Recyle Branch Managers

        //Laboratory Management Tab

Gate::define('manage_recyle_laboratory_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_laboratory' ||
            $permissions[$i]->slug == 'restore_laboratory' ||
            $permissions[$i]->slug == 'permanent_deleted_laboratory'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_laboratory', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_laboratory'

    ) {
            return true;
    }
}
});

Gate::define('restore_laboratory', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_laboratory'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_laboratory', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_laboratory'

    ) {
            return true;
    }
}
});

        //Consultation Session Management Tab

Gate::define('manage_recyle_consultant_sessions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_consultant_sessions' ||
            $permissions[$i]->slug == 'restore_consultant_sessions' ||
            $permissions[$i]->slug == 'permanent_deleted_consultant_sessions'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_consultant_sessions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_consultant_sessions'

    ) {
            return true;
    }
}
});

Gate::define('restore_consultant_sessions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_consultant_sessions'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_consultant_sessions', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_consultant_sessions'

    ) {
            return true;
    }
}
});



        //Testimonials  Management Tab

Gate::define('manage_recyle_testimonials_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_testimonials' ||
            $permissions[$i]->slug == 'restore_testimonials' ||
            $permissions[$i]->slug == 'permanent_deleted_testimonials'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_testimonials', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_testimonials'

    ) {
            return true;
    }
}
});

Gate::define('restore_testimonials', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_testimonials'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_testimonials', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_testimonials'

    ) {
            return true;
    }
}
});

        //Social Links  Management Tab

Gate::define('manage_recyle_social_links_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_social_links' ||
            $permissions[$i]->slug == 'restore_social_links' ||
            $permissions[$i]->slug == 'permanent_deleted_social_links'
        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_social_links', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_social_links'

    ) {
            return true;
    }
}
});

Gate::define('restore_social_links', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_social_links'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_social_links', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_social_links'

    ) {
            return true;
    }
}
});

///////////////////////////////////////////

        //Recycle Misc Data Management

Gate::define('manage_recycle_bin_misc_management', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (

            $permissions[$i]->slug == 'view_deleted_blog' ||
            $permissions[$i]->slug == 'restore_blog' ||
            $permissions[$i]->slug == 'permanent_deleted_blog' ||
            $permissions[$i]->slug == 'view_deleted_specialization' ||
            $permissions[$i]->slug == 'restore_specialization' ||
            $permissions[$i]->slug == 'permanent_deleted_specialization' ||
            $permissions[$i]->slug == 'view_deleted_health_complaints' ||
            $permissions[$i]->slug == 'restore_health_complaints' ||
            $permissions[$i]->slug == 'permanent_deleted_health_complaints' ||
            $permissions[$i]->slug == 'view_deleted_our_teams' ||
            $permissions[$i]->slug == 'restore_our_teams' ||
            $permissions[$i]->slug == 'permanent_deleted_our_teams' ||
            $permissions[$i]->slug == 'view_deleted_test' ||
            $permissions[$i]->slug == 'restore_test' ||
            $permissions[$i]->slug == 'permanent_deleted_test' ||

            $permissions[$i]->slug == 'view_deleted_job' ||
            $permissions[$i]->slug == 'restore_job' ||
            $permissions[$i]->slug == 'permanent_deleted_job' ||


            $permissions[$i]->slug == 'view_deleted_exercise' ||
            $permissions[$i]->slug == 'restore_exercise' ||
            $permissions[$i]->slug == 'permanent_deleted_exercise' ||

            $permissions[$i]->slug == 'view_deleted_recipe_categories' ||
            $permissions[$i]->slug == 'restore_recipe_categories' ||
            $permissions[$i]->slug == 'permanent_deleted_recipe_categories' ||
            $permissions[$i]->slug == 'view_deleted_recipe' ||
            $permissions[$i]->slug == 'restore_recipe' ||
            $permissions[$i]->slug == 'permanent_deleted_recipe' ||
            $permissions[$i]->slug == 'view_deleted_diet_categories' ||
            $permissions[$i]->slug == 'restore_diet_categories' ||
            $permissions[$i]->slug == 'permanent_delete_diet_categories' ||
            $permissions[$i]->slug == 'view_deleted_diet' ||
            $permissions[$i]->slug == 'restore_diet' ||
            $permissions[$i]->slug == 'permanent_deleted_diet'
        ) {
            return true;
        }
    }
});

        //Recyle blog....................

Gate::define('manage_recyle_blog_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_blog' ||
            $permissions[$i]->slug == 'restore_blog' ||
            $permissions[$i]->slug == 'permanent_deleted_blog'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_blog'

    ) {
            return true;
    }
}
});

Gate::define('restore_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_blog'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_blog', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_blog'

    ) {
            return true;
    }
}
});

        //Recyle specialization....................

Gate::define('manage_recyle_specialization_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_specialization' ||
            $permissions[$i]->slug == 'restore_specialization' ||
            $permissions[$i]->slug == 'permanent_deleted_specialization'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_specialization'

    ) {
            return true;
    }
}
});

Gate::define('restore_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_specialization'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_specialization', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_specialization'

    ) {
            return true;
    }
}
});

        //Recyle health_complaints....................

Gate::define('manage_recyle_health_complaints_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_health_complaints' ||
            $permissions[$i]->slug == 'restore_health_complaints' ||
            $permissions[$i]->slug == 'permanent_deleted_health_complaints'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_health_complaints', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_health_complaints'

    ) {
            return true;
    }
}
});

Gate::define('restore_health_complaints', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_health_complaints'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_health_complaints', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_health_complaints'

    ) {
            return true;
    }
}
});

        //Recyle  our_teams.....................

Gate::define('manage_recyle_our_teams_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_our_teams' ||
            $permissions[$i]->slug == 'restore_our_teams' ||
            $permissions[$i]->slug == 'permanent_deleted_our_teams'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_our_teams', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_our_teams'

    ) {
            return true;
    }
}
});

Gate::define('restore_our_teams', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_our_teams'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_our_teams', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_our_teams'

    ) {
            return true;
    }
}
});

        //Recyle     test.....................

Gate::define('manage_recyle_test_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_test' ||
            $permissions[$i]->slug == 'restore_test' ||
            $permissions[$i]->slug == 'permanent_deleted_test'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_test'

    ) {
            return true;
    }
}
});

Gate::define('restore_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_test'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_test', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_test'

    ) {
            return true;
    }
}
});



           //Recyle     JOB.....................

Gate::define('manage_recyle_job_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
          $permissions[$i]->slug == 'view_deleted_job' ||
          $permissions[$i]->slug == 'restore_job' ||
          $permissions[$i]->slug == 'permanent_deleted_job' 

      ) {
            return true;
        }
    }
});

Gate::define('view_deleted_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_job'

    ) {
            return true;
    }
}
});

Gate::define('restore_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_job'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_job', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_job'

    ) {
            return true;
    }
}
});




           //Recyle     Exercise.....................

Gate::define('manage_recyle_exercise_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
          $permissions[$i]->slug == 'view_deleted_exercise' ||
          $permissions[$i]->slug == 'restore_exercise' ||
          $permissions[$i]->slug == 'permanent_deleted_exercise' 

      ) {
            return true;
        }
    }
});

Gate::define('view_deleted_exercise', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_exercise'

    ) {
            return true;
    }
}
});

Gate::define('restore_exercise', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_exercise'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_exercise', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_exercise'

    ) {
            return true;
    }
}
});

        //Recyle     recipe_categories.....................

Gate::define('manage_recyle_recipe_categories_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_recipe_categories' ||
            $permissions[$i]->slug == 'restore_recipe_categories' ||
            $permissions[$i]->slug == 'permanent_deleted_recipe_categories'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_recipe_categories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_recipe_categories'

    ) {
            return true;
    }
}
});

Gate::define('restore_recipe_categories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_recipe_categories'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_recipe_categories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_recipe_categories'

    ) {
            return true;
    }
}
});

        //Recyle     petty_expense_ sub category.....................

Gate::define('manage_recyle_recipe_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_recipe' ||
            $permissions[$i]->slug == 'restore_recipe' ||
            $permissions[$i]->slug == 'permanent_deleted_recipe'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_recipe'

    ) {
            return true;
    }
}
});

Gate::define('restore_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_recipe'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_recipe', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_recipe'

    ) {
            return true;
    }
}
});

        //Recyle  diet_categories category.....................

Gate::define('manage_recyle_diet_categories_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_diet_categories' ||
            $permissions[$i]->slug == 'restore_diet_categories' ||
            $permissions[$i]->slug == 'permanent_delete_diet_categories'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_diet_categories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_diet_categories'

    ) {
            return true;
    }
}
});

Gate::define('restore_diet_categories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_diet_categories'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_diet_categories', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_diet_categories'

    ) {
            return true;
    }
}
});

        //Recyle  maintenance_sub category.....................

Gate::define('manage_recyle_diet_tab', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if (
            $permissions[$i]->slug == 'view_deleted_diet' ||
            $permissions[$i]->slug == 'restore_diet' ||
            $permissions[$i]->slug == 'permanent_deleted_diet'

        ) {
            return true;
        }
    }
});

Gate::define('view_deleted_diet', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'view_deleted_diet'

    ) {
            return true;
    }
}
});

Gate::define('restore_diet', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'restore_diet'

    ) {
            return true;
    }
}
});

Gate::define('permanent_deleted_diet', function ($user) {
    $user = Auth::user();
    $permissions = $user->role->permissions;
    for ($i = 0; $i < count($permissions); $i++) {
        if ($permissions[$i]->slug == 'permanent_deleted_diet'

    ) {
            return true;
    }
}
});

/////////////////////////////////////////

}
}
