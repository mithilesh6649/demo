<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Auth;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function rolesList(Request $request)
    {

        if (Auth::user()->can('view_role')) {
            // $roles = Role::orderBy('name')->where('id', '!=', 1)->get();
            //$roles = Role::orderBy('name')->where('tag','!=','super_admin')->get();
            $roles = Role::orderBy('name')->whereNotIn('tag', Role::SKIPPED_ROLES)->get();
            return view('roles/roles_list', ['roles' => $roles]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function viewRole($id)
    {
        if (Auth::user()->can('view_role')) {
            $role = Role::find($id);
            $permissions = \DB::table('permission_role')->where('role_id', $role->id)->get();
            return view('roles/view_role', [
                'role' => $role,
                'permissions' => $permissions,
            ]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function addRole(Request $request)
    {
        if (Auth::user()->can('add_role')) {
            return view('roles/add_role');
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function saveRole(Request $request)
    {
        $nameToLowercase = strtolower($request->role_name);
        $roleTag = $name = str_replace(' ', '_', $nameToLowercase);
        $role = Role::where("tag", $roleTag)->get();
        if (count($role) <= 0) {
            $role = new Role;
            $role->name = $request->role_name;
            $role->tag = $roleTag;
            $role->role_type = 'admins';
            if ($role->save()) {
                $roles = Role::where('id', '!=', 1)->get();
                return redirect()->route('roles_list', ['roles' => $roles])->with('success', 'Role Added successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            $roles = Role::where('id', '!=', 1)->get();
            return redirect()->route('roles_list', ['roles' => $roles])->with('error', 'The Role already exists! Please edit the Role if you want to make any changes.');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function editRole($id)
    {
        if (Auth::user()->can('edit_role')) {
            $role = Role::find($id);
            return view('roles/edit_role', [
                'role' => $role,
            ]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Update Role
     */
    public function updateRole(Request $request)
    {
        $nameToLowercase = strtolower($request->name);
        $roleTag = str_replace(' ', '_', $nameToLowercase);
        $role = Role::where("tag", $roleTag)->get();
        if (count($role) <= 0) {
            $updateRole = Role::where('id', $request->id)->update([
                'name' => $request->name,
                'tag' => $roleTag,
            ]);
            if ($updateRole) {
                $roles = Role::orderByDesc('id')->get();
                return redirect()->route('roles_list', ['roles' => $roles])->with('success', 'Role Updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            $roles = Role::where('id', '!=', 1)->get();
            return redirect()->route('roles_list', ['roles' => $roles])->with('error', 'The Role already exists! Please edit the Role if you want to make any changes.');
        }

    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function getRolePermissions(Request $request)
    {
        $rolePermissions = \DB::table('permission_role')->where('role_id', $request->role_id)->get();
        return json_encode($rolePermissions);
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function rolePermissions(Request $request)
    {

        if (Auth::user()->can('edit_permissions')) {
            // $roles = Role::orderBy('name')->whereIn('tag', ['super_admin','admin'])->get();
            // $roles = Role::orderBy('name')->where('tag','!=', 'super_admin')->get();
            $admin_id = Auth::id();
            $admin = Admin::where('id', $admin_id)->first();
            $roles = Role::orderBy('name')->where('role_type', 'admins')->get();

            if ($roles->isNotEmpty()) {
                $usersPermissions = Permission::where('module_slug', 'users')->get();
                $NutritionistPermissions = Permission::where('module_slug', 'nutritionist')->get();
                $adminsPermissions = Permission::where('module_slug', 'admins')->get();
                $AppointmentsPermissions = Permission::where('module_slug', 'appointments')->get();
                $TestReportsPermissions = Permission::where('module_slug', 'test_reports')->get();
                $HelpAndSupportPermissions = Permission::where('module_slug', 'help_and_support')->get();

                $LaboratoriesPermissions = Permission::where('module_slug', 'laboratories')->get();

                $ReviewPermissions = Permission::where('module_slug', 'review')->get();
                $contactusPermissions = Permission::where('module_slug', 'manage_contact_us')->get();

                $subscribersPermissions = Permission::where('module_slug', 'manage_subscribers')->get();
                $referralPatientsPermissions = Permission::where('module_slug', 'referral_patients')->get();

                $MediaPermissions = Permission::where('module_slug', 'media')->get();
                $WebsitePermissions = Permission::where('module_slug', 'website')->get();
                $MobilePermissions = Permission::where('module_slug', 'mobile')->get();
                $SociallinksPermissions = Permission::where('module_slug', 'social_links')->get();
                $SubscriptionPlansPermissions = Permission::where('module_slug', 'subscription_plans')->get();

                $SpecializationPermissions = Permission::where('module_slug', 'specialization')->get();
                $ProjectFeaturesPermissions = Permission::where('module_slug', 'project_features')->get();
                $OurTeamPermissions = Permission::where('module_slug', 'our_team')->get();

                $BlogPermissions = Permission::where('module_slug', 'blog')->get();

                $DiseasesPermissions = Permission::where('module_slug', 'diseases')->get();
                $AllergiesPermissions = Permission::where('module_slug', 'allergies')->get();
                $TestPermissions = Permission::where('module_slug', 'test')->get();
                $ConsultationsPermissions = Permission::where('module_slug', 'consultations')->get();

                $TestPermissions = Permission::where('module_slug', 'test')->get();
                $RecipeCategoryPermissions = Permission::where('module_slug', 'recipe_category')->get();
                $RecipePermissions = Permission::where('module_slug', 'recipe')->get();

                $DietSubscriptionplansPermissions = Permission::where('module_slug', 'diet_subscription_plans')->get();
                $DietSubscriptionSubplansPermissions = Permission::where('module_slug', 'diet_subscription_sub_plans')->get();

                $DietCategoryPermissions = Permission::where('module_slug', 'diet_category')->get();
                $DietPermissions = Permission::where('module_slug', 'diet')->get();

                $ApiKeyPermissions = Permission::where('module_slug', 'api_keys')->get();
                $NotificationPermissions = Permission::where('module_slug', 'notification')->get();

                $GuideMessagePermissions = Permission::where('module_slug', 'guide_message')->get();

                $feedbacksPermissions = Permission::where('module_slug', 'feedbacks')->get();

                $consultationSessionPermissions = Permission::where('module_slug', 'consultation_session')->get();

                $jobsPermissions = Permission::where('module_slug', 'job')->get();

                $exercisesPermissions = Permission::where('module_slug', 'exercises')->get();
                $mealTemplatePermissions = Permission::where('module_slug', 'meal_template')->get();
                $foodPermissions = Permission::where('module_slug', 'food')->get();
                $rdaPermissions = Permission::where('module_slug', 'rda')->get();
                $traitCategoryPermissions = Permission::where('module_slug', 'trait_category')->get();
                $traitPermissions = Permission::where('module_slug', 'trait')->get();

                $dietSubscriptionFeaturesPermissions = Permission::where('module_slug', 'diet_subscription_features')->get();

                $paymentTransactionsPermissions = Permission::where('module_slug', 'payment_transactions')->get();

                //$mobilePermissions = Permission::where('module_slug', 'mobile_pages')->get();
                $rolesPermissions = Permission::where('module_slug', 'roles')->get();
                $accessPermissions = Permission::where('module_slug', 'permissions')->get();
                $admin_recyclePermissions = Permission::where('module_slug', 'recycle_bin_admins')->get();
                $role_recyclePermissions = Permission::where('module_slug', 'recycle_bin')->get();
                //$my_walletPermissions = Permission::where('module_slug', 'my_wallet')->get();

                return view('roles/role_permissions', [
                    'roles' => $roles,
                    'usersPermissions' => $usersPermissions,
                    'NutritionistPermissions' => $NutritionistPermissions,
                    'adminsPermissions' => $adminsPermissions,
                    'AppointmentsPermissions' => $AppointmentsPermissions,
                    'LaboratoriesPermissions' => $LaboratoriesPermissions,
                    'TestReportsPermissions' => $TestReportsPermissions,
                    'HelpAndSupportPermissions' => $HelpAndSupportPermissions,
                    'DiseasesPermissions' => $DiseasesPermissions,
                    'AllergiesPermissions' => $AllergiesPermissions,

                    'TestPermissions' => $TestPermissions,
                    'MediaPermissions' => $MediaPermissions,
                    'WebsitePermissions' => $WebsitePermissions,
                    'SociallinksPermissions' => $SociallinksPermissions,
                    'SubscriptionPlansPermissions' => $SubscriptionPlansPermissions,
                    'SpecializationPermissions' => $SpecializationPermissions,
                    'ProjectFeaturesPermissions' => $ProjectFeaturesPermissions,
                    'OurTeamPermissions' => $OurTeamPermissions,
                    'ApiKeyPermissions' => $ApiKeyPermissions,
                    'NotificationPermissions' => $NotificationPermissions,
                    'GuideMessagePermissions'=>$GuideMessagePermissions,
                    'jobsPermissions' => $jobsPermissions,
                    'exercisesPermissions' => $exercisesPermissions,
                    'mealTemplatePermissions'=>$mealTemplatePermissions,
                    'foodPermissions' => $foodPermissions,
                    'rdaPermissions' => $rdaPermissions,
                    'traitCategoryPermissions' => $traitCategoryPermissions,
                    'traitPermissions' => $traitPermissions,
                    //'mobilePermissions' => $mobilePermissions,
                    'referralPatientsPermissions' => $referralPatientsPermissions,
                    'ConsultationsPermissions' => $ConsultationsPermissions,
                    'DietSubscriptionplansPermissions' => $DietSubscriptionplansPermissions,
                    'DietSubscriptionSubplansPermissions'=>$DietSubscriptionSubplansPermissions,
                    'rolesPermissions' => $rolesPermissions,
                    'accessPermissions' => $accessPermissions,
                    'contactusPermissions' => $contactusPermissions,
                    'feedbacksPermissions' => $feedbacksPermissions,
                    'admin_recyclePermissions' => $admin_recyclePermissions,
                    'role_recyclePermissions' => $role_recyclePermissions,
                    // /'my_walletPermissions' => $my_walletPermissions,
                    'subscribersPermissions' => $subscribersPermissions,
                    'DietCategoryPermissions' => $DietCategoryPermissions,
                    'DietPermissions' => $DietPermissions,
                    'ReviewPermissions' => $ReviewPermissions,
                    'MobilePermissions' => $MobilePermissions,
                    'BlogPermissions' => $BlogPermissions,
                    'RecipeCategoryPermissions' => $RecipeCategoryPermissions,
                    'RecipePermissions' => $RecipePermissions,
                    'consultationSessionPermissions' => $consultationSessionPermissions,
                    'dietSubscriptionFeaturesPermissions' => $dietSubscriptionFeaturesPermissions,
                    'paymentTransactionsPermissions' => $paymentTransactionsPermissions,
                    'admin' => $admin,
                ]);
            } else {
                return redirect()->route('add_role')->with('warning', 'No Roles Found! Please add a Role first.');
            }
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function saveRolePermissions(Request $request)
    {
        $role = Role::find($request->role_id);
        $updatePermissions = $role->permissions()->sync($request->permissions);
        if ($updatePermissions) {
            $roles = Role::where('id', '!=', 1)->get();
            return back()->with('success', 'Role Permissions Added successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function deleteRole(Request $request)
    {

        $admin = Admin::where('role_id', $request->id)->first();
        $admin_trashed = Admin::where('role_id', $request->id)->withTrashed()->count();

        if ($admin != null || $admin_trashed > 0) {
            $res['success'] = 0;
            $res['message'] = "You cannot delete this record as it's being used.";
            return json_encode($res);
        } else {
            $role = Role::where('id', $request->id)->first();
            $role->permissionRoles()->delete();
            // $role->admins()->delete();
            $deleteRole = $role->delete();
            if ($deleteRole) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                $res['message'] = "Something went wrong! Please try again.";
                return json_encode($res);
            }
        }
    }

    public function deleteRolePermanantly(Request $request)
    {
        $admin = Admin::where('role_id', $request->id)->first();
        if ($admin != null) {
            $res['success'] = 0;
            $res['message'] = "You cannot delete this record as it's being used.";
            return json_encode($res);
        } else {
            $role = Role::where('id', $request->id)->first();
            $role->permissionRoles()->forceDelete();
            $role->admins()->forceDelete();
            $deleteRole = $role->forceDelete();
            if ($deleteRole) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                $res['message'] = "Something went wrong! Please try again.";
                return json_encode($res);
            }
        }
    }

    public function getAllPermissions(Request $request)
    {
        $permissions = Permission::orderBy('name')->get();
        for ($i = 0; $i < count($permissions); $i++) {
            echo $permissions[$i]->id . ' : ' . $permissions[$i]->slug . "<br>";
            echo "\n";
        }
    }

    public function getUserPermissions(Request $request)
    {
        $user = $request->user();
        $permissions = $user->role->permissions;
        for ($i = 0; $i < count($permissions); $i++) {
            echo $permissions[$i]->id . ' : ' . $permissions[$i]->slug . "<br>";
            echo "\n";
        }
    }
}
