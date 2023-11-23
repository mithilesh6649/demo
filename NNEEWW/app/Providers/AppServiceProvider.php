<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('add_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_admin') {
                    return true;
                }
            }
        });
        Gate::define('edit_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_admin') {
                    return true;
                }
            }
        });
        Gate::define('delete_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_admin') {
                    return true;
                }
            }
        });
        Gate::define('view_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_admin') {
                    return true;
                }
            }
        });
        Gate::define('add_teacher', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_teacher') {
                    return true;
                }
            }
        });
        Gate::define('edit_teacher', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_teacher') {
                    return true;
                }
            }
        });

        Gate::define('delete_teacher', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_teacher') {
                    return true;
                }
            }
        });
        Gate::define('view_teacher', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_teacher') {
                    return true;
                }
            }
        });
        
        // student
        Gate::define('add_student', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_student') {
                    return true;
                }
            }
        });
        Gate::define('edit_student', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_student') {
                    return true;
                }
            }
        });
        Gate::define('view_student', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_student') {
                    return true;
                }
            }
        });
        Gate::define('delete_student', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_student') {
                    return true;
                }
            }
        });
        
        // student

        // school
        Gate::define('add_school', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_school') {
                    return true;
                }
            }
        });
        Gate::define('edit_school', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_school') {
                    return true;
                }
            }
        });
        Gate::define('delete_school', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_school') {
                    return true;
                }
            }
        });
        Gate::define('view_school', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_school') {
                    return true;
                }
            }
        });
        // school

        // website content
        Gate::define('edit_website_page', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_website_page') {
                    return true;
                }
            }
        });
        Gate::define('view_website_page', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_website_page') {
                    return true;
                }
            }
        });
        Gate::define('edit_mobile_page', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_mobile_page') {
                    return true;
                }
            }
        });
        Gate::define('view_mobile_page', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_mobile_page') {
                    return true;
                }
            }
        });
        // website content

        // role
        Gate::define('add_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_role') {
                    return true;
                }
            }
        });
        Gate::define('edit_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_role') {
                    return true;
                }
            }
        });
        Gate::define('view_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_role') {
                    return true;
                }
            }
        });
        Gate::define('delete_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_role') {
                    return true;
                }
            }
        });
        // role
        // add permission
        Gate::define('add_permissions', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_permissions') {
                    return true;
                }
            }
        });
        // add permission
        Gate::define('restore_teachers', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_teachers') {
                    return true;
                }
            }
        });
        Gate::define('permanent_delete_teachers', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_teachers') {
                    return true;
                }
            }
        });
        Gate::define('restore_students', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_students') {
                    return true;
                }
            }
        });
        Gate::define('permanent_delete_students', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_students') {
                    return true;
                }
            }
        });
        Gate::define('restore_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_admin') {
                    return true;
                }
            }
        });
        Gate::define('permanent_delete_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_admin') {
                    return true;
                }
            }
        });
        Gate::define('restore_school', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_school') {
                    return true;
                }
            }
        });
        Gate::define('permanent_delete_schools', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_schools') {
                    return true;
                }
            }
        });
        Gate::define('restore_courses', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_courses') {
                    return true;
                }
            }
        });
        Gate::define('permanent_delete_courses', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_courses') {
                    return true;
                }
            }
        });
        Gate::define('restore_roles', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_roles') {
                    return true;
                }
            }
        });
        Gate::define('permanent_delete_roles', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_roles') {
                    return true;
                }
            }
        });
        Gate::define('view_instructors', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_instructors') {
                    return true;
                }
            }
        });
        Gate::define('view_students', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_students') {
                    return true;
                }
            }
        });

        // reports added later
        Gate::define('view_reports', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_reports') {
                    return true;
                }
            }
        });
        // reports added later

        Gate::define('view_feedbacks', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_feedbacks') {
                    return true;
                }
            }
        });
        Gate::define('view_payments', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_payments') {
                    return true;
                }
            }
        });
        Gate::define('view_crypto_wallet_users', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_crypto_wallet_users') {
                    return true;
                }
            }
        });
        Gate::define('view_cards', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_user_card') {
                    return true;
                }
            }
        });
        Gate::define('view_my_wallet', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_my_wallet') {
                    return true;
                }
            }
        });
    }
}
