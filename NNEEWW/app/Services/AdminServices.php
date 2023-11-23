<?php

namespace App\Services;
use DB;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\PaymentTransaction; 
class AdminServices 
{
    public function dashboardIndex()
    {

        $users = DB::table('users')->whereNull('deleted_at')->count();
        $admins = DB::table('admins')->where('id','!=',1)->whereNull('deleted_at')->count();
        $web_users = DB::table('web_users')->whereNull('deleted_at')->count();
        $appointments = DB::table('appointments')->whereNull('deleted_at')->count();
        $laboratories = DB::table('laboratories')->whereNull('deleted_at')->count();

        $consultant_sessions = DB::table('consultant_sessions')->whereNull('deleted_at')->count();
        $contact_us = DB::table('contact_us')->whereNull('deleted_at')->count();
        $newsletter_subscriptions = DB::table('newsletter_subscriptions')->count();
        $referral_patients = DB::table('referral_patients')->whereNull('deleted_at')->count();
        $blogs = DB::table('blogs')->whereNull('deleted_at')->count();
        $diets = DB::table('diets')->whereNull('deleted_at')->count();
        $recipes = DB::table('recipes')->whereNull('deleted_at')->count();
        $allPayments = PaymentTransaction::count();
        
          $allPayments = PaymentTransaction::count(); 
          $allEarnings = PaymentTransaction::sum('amount');

        $tests = DB::table('tests')->count();

        $exercises = DB::table('exercises')->count();

        $web_contents = DB::table('pages')->where('device_type','web')->count();
        $mobile_contents = DB::table('pages')->where('device_type','mobile')->count();
        $roles = Role::whereNotIn('tag',Role::SKIPPED_ROLES)->count();  
        
        $geneticTest = Ticket::where('ticket_type', Ticket::TestType)->count();
        $ticket_type_ids = [1, 2, 4, 6, 7, 8, 9, 10, 11, 12];
        $helpSupport = Ticket::whereIn('ticket_type', $ticket_type_ids)->count();
        return [
            'usersCount' => $users,
            'adminsCount' => $admins,
            'nutritionistCount' => $web_users,
            'appointmentsCount' => $appointments,
            'laboratoriesCount' => $laboratories,
            
            'consultantSessionsCount' => $consultant_sessions,
            'contactUsCount' => $contact_us,
            'newsletterSubscriptionsCount' => $newsletter_subscriptions,
            'referralPatientsCount' => $referral_patients,
            'blogsCount' => $blogs,
            'recipesCount' => $recipes,
            'dietsCount' => $diets,
            'allPaymentsCount'=>$allPayments,
            'allEarnings'=>$allEarnings,  
            'testsCount' => $tests,
            'rolesCount' => $roles,
            'exercisesCount' => $exercises,
            'feedbackCount'=>$tests,
            'webCount'=>$web_contents,
            'mobileCount'=>$mobile_contents,
            'geneticTestCount'=>$geneticTest,
            'helpSupportCount'=>$helpSupport,
        ];
    }
}
