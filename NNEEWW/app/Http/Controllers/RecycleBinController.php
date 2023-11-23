<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Test;
use App\Models\User;
use App\Models\Admin;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use App\Models\Nutritionist;
use App\Models\Specialization;
use App\Models\HealthComplaint;
use App\Models\SubscriptionPlan;
use App\Models\ConsultantSession;
use App\Models\ReferralPatient;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\Blog;
 
 
use App\Models\OurTeam;
use App\Models\Exercise;
use App\Models\CurrentOpening; 
use App\Models\RecipeCategory;
use App\Models\Recipe;
use App\Models\DietCategory;
use App\Models\Dite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecycleBinController extends Controller
{

    //** USER MANAGEMENT */

    public function deletedUsersList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = User::onlyTrashed()->get();
        return view('recycle_bin/users', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreUser(Request $request)
    {

        $user = User::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteUser(Request $request)
    {

        $user = User::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }





    //** NUTRITIONISR MANAGEMENT */ 

    public function deletedNutritionistList()
    {
        //if(Auth::user()->can('restore_users')) {
       $userId = Role::where('role_type', 'users')->where('tag', 'nutritionist')->value('id');

       $deletedUsers = Nutritionist::where('role_id', $userId)->orderBy("id", 'DESC')->onlyTrashed()->get();
       return view('recycle_bin/nutritionist', [
        'deletedUsers' => $deletedUsers,
    ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
   }

    /**
     * This function is used to Restore User
     */
    public function restoreNutritionist(Request $request)
    {

        $user = Nutritionist::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteNutritionist(Request $request)
    {

        $user = Nutritionist::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /** ADMIN MANAGEMENT */

    /**
     * This function is used to Fetch Deleted Admins
     */
    public function deletedAdminsList()
    {
      //  if (Auth::user()->can('restore_admin')) {
        $deletedAdmins = Admin::onlyTrashed()->get();
        return view('recycle_bin/admins', [
            'deletedAdmins' => $deletedAdmins,
        ]);
        // } else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore Admin
     */
    public function restoreAdmin(Request $request)
    {

        $restoreAdmin = Admin::where('id', $request->id)->restore();
        if ($restoreAdmin) {
            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 2;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete Admin
     */
    public function permanentDeleteAdmin(Request $request)
    {
        $deleteAdmin = Admin::where('id', $request->id)->forceDelete();
        if ($deleteAdmin) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    //** LABORATORY MANAGEMENT */

    public function deletedLaboratoriesList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedLaboratories = Laboratory::onlyTrashed()->get();
        return view('recycle_bin/laboratories', [
            'deletedLaboratories' => $deletedLaboratories,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreLaboratories(Request $request)
    {

        $Laboratory = Laboratory::where('id', $request->id)->onlyTrashed()->first();

        if ($Laboratory->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteLaboratories(Request $request)
    {

        $Laboratory = Laboratory::where('id', $request->id)->onlyTrashed()->first();

        if ($Laboratory->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }


   //** ConsultantSessions MANAGEMENT */

    public function deletedConsultantSessionsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = ConsultantSession::onlyTrashed()->get();
        return view('recycle_bin/consultation_session', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreConsultantSessions(Request $request)
    {

        $user = ConsultantSession::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteConsultantSessions(Request $request)
    {

        $user = ConsultantSession::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }




   

     //**  Clinicians  MANAGEMENT */

    public function deletedCliniciansList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = ReferralPatient::onlyTrashed()->get();
        return view('recycle_bin/clinicians', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreClinicians(Request $request)
    {

        $user = ReferralPatient::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteClinicians(Request $request)
    {

        $user = ReferralPatient::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }



      //**  Testimonials  MANAGEMENT */

    public function deletedTestimonialsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = Testimonial::onlyTrashed()->get();
        return view('recycle_bin/testimonials', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreTestimonials(Request $request)
    {

        $user = Testimonial::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteTestimonials(Request $request)
    {

        $user = Testimonial::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }


    
          //**  SocialLinks  MANAGEMENT */

    public function deletedSocialLinksList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = SocialLink::onlyTrashed()->get();
        return view('recycle_bin/social_links', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreSocialLinks(Request $request)
    {

        $user = SocialLink::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteSocialLinks(Request $request)
    {

        $user = SocialLink::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

      

           //**  Blog  MANAGEMENT */

    public function deletedBlogsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = Blog::onlyTrashed()->get();
        return view('recycle_bin/blogs', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreBlogs(Request $request)
    {

        $user = Blog::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteBlogs(Request $request)
    {

        $user = Blog::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }









           //**  Specialization  MANAGEMENT */

    public function deletedSpecializationList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = Specialization::onlyTrashed()->get();
        return view('recycle_bin/specializations', [
            'Specialization' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreSpecialization(Request $request)
    {

        $user = Specialization::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteSpecialization(Request $request)
    {

        $user = Specialization::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    



           //**  HealthComplaints  MANAGEMENT */

    public function deletedHealthComplaintsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = HealthComplaint::onlyTrashed()->get();
        return view('recycle_bin/health_complaints', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreHealthComplaints(Request $request)
    {

        $user = HealthComplaint::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteHealthComplaints(Request $request)
    {

        $user = HealthComplaint::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }
    


         //**  OurTeams  MANAGEMENT */

    public function deletedOurTeamsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = OurTeam::onlyTrashed()->get();
        return view('recycle_bin/our_teams', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }



     public function restoreOurTeams(Request $request)
    {

        $user = OurTeam::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteOurTeams(Request $request)
    {

        $user = OurTeam::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Restore User
     */
   


    //** Test MANAGEMENT */

    public function deletedTestList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedTest = Test::onlyTrashed()->get();
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        return view('recycle_bin/test', [
            'deletedTest' => $deletedTest,
            'genetic_test_types'=>$genetic_test_type
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreTest(Request $request)
    {

        $Test = Test::where('id', $request->id)->onlyTrashed()->first();

        if ($Test->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteTest(Request $request)
    {

        $Test = Test::where('id', $request->id)->onlyTrashed()->first();

        if ($Test->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }





    
         //**  JOB  MANAGEMENT */

    public function deletedJobList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = CurrentOpening::onlyTrashed()->get();
        return view('recycle_bin/jobs', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }



     public function restoreJob(Request $request)
    {

        $user = CurrentOpening::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteJob(Request $request)
    {

        $user = CurrentOpening::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    


       //**  Exercise  MANAGEMENT */

    public function deletedExerciseList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = Exercise::onlyTrashed()->get();
        return view('recycle_bin/exercise', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }



     public function restoreExercise(Request $request)
    {

        $user = Exercise::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteExercise(Request $request)
    {

        $user = Exercise::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

   



         //**  deletedRecipeCategoryList  MANAGEMENT */

    public function deletedRecipeCategoryList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = RecipeCategory::onlyTrashed()->get();
        return view('recycle_bin/recipe_categories', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreRecipeCategory(Request $request)
    {

        $user = RecipeCategory::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteRecipeCategory(Request $request)
    {

        $user = RecipeCategory::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }




            //**  deletedRecipeCategoryList  MANAGEMENT */

    public function deletedRecipesList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = Recipe::onlyTrashed()->get();
        return view('recycle_bin/recipe', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreRecipes(Request $request)
    {

        $user = Recipe::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteRecipes(Request $request)
    {

        $user = Recipe::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }




   


         //**  deletedDietCategoryList  MANAGEMENT */

    public function deletedDietCategoryList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = DietCategory::onlyTrashed()->get();
        return view('recycle_bin/diet_categories', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreDietCategory(Request $request)
    {

        $user = DietCategory::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteDietCategory(Request $request)
    {

        $user = DietCategory::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }
   



    //**  deletedDietCategoryList  MANAGEMENT */

    public function deletedDietsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $deletedUsers = Dite::onlyTrashed()->get();
        return view('recycle_bin/diet', [
            'deletedUsers' => $deletedUsers,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreDiets(Request $request)
    {

        $user = Dite::where('id', $request->id)->onlyTrashed()->first();

        if ($user->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteDiets(Request $request)
    {

        $user = Dite::where('id', $request->id)->onlyTrashed()->first();

        if ($user->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }





    //** SubscriptionPlan MANAGEMENT */

    public function deletedSubscriptionPlanList()
    {
        //if(Auth::user()->can('restore_users')) {

        $SubscriptionPlan = SubscriptionPlan::onlyTrashed()->get();
        return view('recycle_bin/subscription_plans', [
            'SubscriptionPlan' => $SubscriptionPlan,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreSubscriptionPlan(Request $request)
    {

        $SubscriptionPlan = SubscriptionPlan::where('id', $request->id)->onlyTrashed()->first();

        if ($SubscriptionPlan->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteSubscriptionPlan(Request $request)
    {

        $SubscriptionPlan = SubscriptionPlan::where('id', $request->id)->onlyTrashed()->first();

        if ($SubscriptionPlan->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    //** Specialization MANAGEMENT */

    public function deletedSpecializationsList()
    {
        //if(Auth::user()->can('restore_users')) {

        $Specialization = Specialization::onlyTrashed()->get();
        return view('recycle_bin/specializations', [
            'Specialization' => $Specialization,
        ]);
        // }
        // else {
        //     return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        // }
    }

    /**
     * This function is used to Restore User
     */
    public function restoreSpecializations(Request $request)
    {

        $Specialization = Specialization::where('id', $request->id)->onlyTrashed()->first();

        if ($Specialization->restore()) {

            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete User
     */
    public function permanentDeleteSpecializations(Request $request)
    {

        $Specialization = Specialization::where('id', $request->id)->onlyTrashed()->first();

        if ($Specialization->forceDelete()) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 0;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Fetch Deleted Roles
     */
    public function deletedRolesList()
    {
        if (Auth::user()->can('restore_roles')) {
            $deletedRoles = Role::onlyTrashed()->get();
            return view('recycle_bin/roles', [
                'deletedRoles' => $deletedRoles,
            ]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Restore Role
     */
    public function restoreRole(Request $request)
    {
        $role = Role::where('id', $request->id)->onlyTrashed()->first();
        $permissionRoles = $role->permissionRoles()->onlyTrashed()->get();
        // $admins = $role->admins()->onlyTrashed()->get();
        $permissionRoles->each(function ($permissionRole) {
            $permissionRole->restore();
        });
        // $admins->each(function($admin) {
        //     $admin->restore();
        // });
        $restoreRole = $role->restore();
        if ($restoreRole) {
            $response['success'] = 1;
            $response['message'] = "Restored Successfully!";
        } else {
            $response['success'] = 2;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

    /**
     * This function is used to Permanent Delete Role
     */
    public function permanentDeleteRole(Request $request)
    {
        $role = Role::where('id', $request->id)->onlyTrashed()->first();
        $permissionRoles = $role->permissionRoles()->onlyTrashed()->get();
        // $admins = $role->admins()->onlyTrashed()->get();
        $permissionRoles->each(function ($permissionRole) {
            $permissionRole->forceDelete();
        });
        // $admins->each(function($admin) {
        //     $admin->forceDelete();
        // });
        $restoreRole = $role->forceDelete();
        if ($restoreRole) {
            $response['success'] = 1;
            $response['message'] = "Deleted Successfully!";
        } else {
            $response['success'] = 2;
            $response['message'] = "Something went wrong! Please try again.";
        }
        return $response;
    }

}
