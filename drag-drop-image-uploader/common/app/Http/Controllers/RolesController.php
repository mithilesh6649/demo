<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Auth;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * This function is used to Show Saved Jobs Listing
     */
    function list(Request $request) {
        if (Auth::user()->can('manage_roles')) {
            $roles = Role::orderBy('name')
                ->where('id', '!=', 1)->where('role_type', 'admin')
                ->get();
            return view('admins.roles.list', ['roles' => $roles]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function view($id)
    {
        if (Auth::user()->can('view_role')) {
            $role = Role::find($id);
            $permissions = \DB::table('permission_role')
                ->where('role_id', $role->id)
                ->get();
            return view('admins.roles.view', [
                'role' => $role,
                'permissions' => $permissions,
            ]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function add(Request $request)
    {
        if (Auth::user()->can('add_role')) {
            return view('admins.roles.add');
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function save(Request $request)
    {

        $nameToLowercase = strtolower($request->role_name);
        $roleTag = $name = str_replace(' ', '_', $nameToLowercase);

        $role = new Role();
        $role->name = $request->role_name;
        $role->tag = $roleTag;
        $role->role_type = 'admin';
        $role->status = 1;
        if ($role->save()) {
            $roles = Role::where('id', '!=', 1)->get();
            return redirect()
                ->route('admins.role.list', ['roles' => $roles])
                ->with('success', 'Role Added successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong!');
        }

        //  dd($request->all());
        // // if (Auth::user()->can('edit_role')) {
        //     $nameToLowercase = strtolower($request->role_name);
        //     $roleTag = $name = str_replace(' ', '_', $nameToLowercase);
        //     $roleType = $name = str_replace(' ', '_', $nameToLowercase);
        //     $role = Role::where("tag", $roleTag)->get();

        //     if (count($role) <= 0) {
        //         $role = new Role();
        //         $role->name = $request->role_name;
        //         $role->tag = $roleTag;
        //         $role->role_type = $roleType;
        //         $role->status = 1;
        //         if ($role->save()) {
        //             $roles = Role::where('id', '!=', 1)->get();
        //             return redirect()
        //                 ->route('admins.role.list', ['roles' => $roles])
        //                 ->with('success', 'Role Added successfully!');
        //         } else {
        //             return redirect()
        //                 ->back()
        //                 ->with('error', 'Something went wrong!');
        //         }
        //     } else {
        //         $roles = Role::where('id', '!=', 1)->get();
        //         return redirect()
        //             ->route('admins.role.list', ['roles' => $roles])
        //             ->with(
        //                 'error',
        //                 'The Role already exists! Please edit the Role if you want to make any changes.'
        //             );
        //     }
        // // } else {
        // //     return redirect()
        // //         ->route('dashboard')
        // //         ->with(
        // //             'warning',
        // //             'You do not have permission for this action!'
        // //         );
        // // }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function edit($id)
    {
        if (Auth::user()->can('edit_role')) {
            $role = Role::find($id);
            return view('admins.roles.edit', [
                'role' => $role,
            ]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Update Role
     */
    public function update(Request $request)
    {
        if (Auth::user()->can('edit_role')) {
            $updateRole = Role::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
            if ($updateRole) {
                $roles = Role::orderByDesc('id')->get();
                return redirect()
                    ->route('admins.role.list', ['roles' => $roles])
                    ->with('success', 'Role Updated successfully!');
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function getRolePermissions(Request $request)
    {
        $rolePermissions = \DB::table('permission_role')
            ->where('role_id', $request->role_id)
            ->get();
        return json_encode($rolePermissions);
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function permissions(Request $request)
    {

        if (Auth::user()->can('manage_permissions')) {
            $roles = Role::orderBy('name')
                ->where('id', '!=', 1)->where('role_type', 'admin')
                ->get();
            if ($roles->isNotEmpty()) {
                $appUsersPermissions = Permission::where(
                    'module_slug',
                    'manage_customer'
                )->get();
                $adminPermissions = Permission::where(
                    'module_slug',
                    'manage_admin'
                )->get();
                $branchManagerPermissions = Permission::where(
                    'module_slug',
                    'manage_branch_manager'
                )->get();

                $branchStaffPermissions = Permission::where(
                    'module_slug',
                    'manage_branch_staff'
                )->get();


                $ManagementPermissions = Permission::where(
                    'module_slug',
                    'manage_management'
                )->get();

                

                $branchLocalityPermissions = Permission::where(
                    'module_slug',
                    'manage_branch_locality'
                )->get();

                $branchPermissions = Permission::where(
                    'module_slug',
                    'manage_branch'
                )->get();

                $menuCategoryPermissions = Permission::where(
                    'module_slug',
                    'manage_menu_category'
                )->get();

                $menuItemPermissions = Permission::where(
                    'module_slug',
                    'manage_menu_item'
                )->get();

                $menuItemAvailabilityPermissions = Permission::where(
                    'module_slug',
                    'manage_menu_item_availability'
                )->get();

                $cateringPermissions = Permission::where(
                    'module_slug',
                    'manage_catering'
                )->get();


                $CurrentOfferPermissions = Permission::where(
                    'module_slug',
                    'manage_current_offer'
                )->get();

                $offerPermissions = Permission::where(
                    'module_slug',
                    'manage_checkout_offer'
                )->get();

                $discountPermissions = Permission::where(
                    'module_slug',
                    'manage_discount_offer'
                )->get();

                $couponPermissions = Permission::where(
                    'module_slug',
                    'manage_coupon_offer'
                )->get();

                $giftCardPermissions = Permission::where(
                    'module_slug',
                    'manage_gift_card'
                )->get();

                $loyaltyPermissions = Permission::where(
                    'module_slug',
                    'manage_loyalty'
                )->get();

                $blogPermissions = Permission::where(
                    'module_slug',
                    'manage_blog'
                )->get();

                $orderPermissions = Permission::where(
                    'module_slug',
                    'manage_order'
                )->get();
                $transactionPermissions = Permission::where(
                    'module_slug',
                    'payment_transaction'
                )->get();

                $websiteContentPermissions = Permission::where(
                    'module_slug',
                    'manage_website_content'
                )->get();

                $bannerContentPermissions = Permission::where(
                    'module_slug',
                    'manage_banner'
                )->get();

                 $MediaContentPermissions = Permission::where(
                    'module_slug',
                    'manage_media'
                )->get();

                $ThemeContentPermissions = Permission::where(
                    'module_slug',
                    'manage_theme'
                )->get();

                $SocialLinkContentPermissions = Permission::where(
                    'module_slug',
                    'manage_social_link'
                )->get();


                $contactUSPermissions = Permission::where(
                    'module_slug',
                    'manage_contact_us'
                )->get();
                $reviewPermissions = Permission::where(
                    'module_slug',
                    'manage_review'
                )->get();
                $joinusPermissions = Permission::where(
                    'module_slug',
                    'manage_joinus'
                )->get();
                

                $brandsPermissions = Permission::where(
                    'module_slug',
                    'manage_brand'
                )->get();

  
                $subsidiariesPermissions = Permission::where(
                    'module_slug',
                    'manage_subsidiaries'
                )->get();

                $blocksPermissions = Permission::where(
                    'module_slug',
                    'manage_blocks'
                )->get();




                $cityPermissions = Permission::where(
                    'module_slug',
                    'manage_city'
                )->get();

                $questionPermissions = Permission::where(
                    'module_slug',
                    'manage_question'
                )->get();

                  $designationsPermissions = Permission::where(
                    'module_slug',
                    'manage_designations'
                )->get();


                $PettyECatPermissions = Permission::where(
                    'module_slug',
                    'manage_petty_exp_category'
                )->get();

                $PettyESubCatPermissions = Permission::where(
                    'module_slug',
                    'manage_petty_exp_sub_category'
                )->get();

                $MaintenanceCatPermissions = Permission::where(
                    'module_slug',
                    'manage_maintenance_category'
                )->get();

                $MaintenanceSubCatPermissions = Permission::where(
                    'module_slug',
                    'manage_maintenance_sub_category'
                )->get();

                $ownershipPermissions = Permission::where(
                    'module_slug',
                    'manage_ownership'
                )->get();

                $driverPermissions = Permission::where(
                    'module_slug',
                    'manage_driver'
                )->get();

                $carPermissions = Permission::where(
                    'module_slug',
                    'manage_car'
                )->get();

                $rolesPermissions = Permission::where(
                    'module_slug',
                    'manage_roles'
                )->get();

                $reportsPermissions = Permission::where(
                    'module_slug',
                    'manage_reports'
                )->get();

                //Reports management

                $CashDepositeReportsPermissions = Permission::where(
                    'module_slug',
                    'manage_cash_deposite_reports'
                )->get();

                $DailySalesReportsPermissions = Permission::where(
                    'module_slug',
                    'manage_daily_sales_reports'
                )->get();

                $PaymentMethodsBranchWisePermissions = Permission::where(
                    'module_slug',
                    'manage_payment_methods_branch_wise_reports'
                )->get();

                $SalesByBranchPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_branch_reports'
                )->get();

                  $SalesByBranchNetSalePermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_branch_net_sale_reports'
                )->get();
                 

                     $SalesByBranchGrossSaleMonthlyPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_branch_gross_sale_monthly_reports'
                )->get();


                     $SalesByBranchNetSaleMonthlyPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_branch_net_sale_monthly_reports'
                )->get();


 
                $SalesByBranchDiscountSalePermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_branch_discount_sale_reports'
                )->get();


                         $SalesByBranchDiscountComplemenrtyReturnPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_branch_dis_com_return_reports'
                )->get();




                $SalesByMonthPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_month_reports'
                )->get();

                $SalesByServicePermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_service_reports'
                )->get();

                  $SalesByComplimentaryPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_by_complimentary_reports'
                )->get();

                $BranchPettyCashPermissions = Permission::where(
                    'module_slug',
                    'manage_branch_petty_cash_reports'
                )->get();

                $PettyByBranchPermissions = Permission::where(
                    'module_slug',
                    'manage_petty_cash_by_branch_reports'
                )->get();

                $PettyByMonthPermissions = Permission::where(
                    'module_slug',
                    'manage_petty_cash_by_month_reports'
                )->get();

                  $CarWiseFulePermissions = Permission::where(
                    'module_slug',
                    'manage_car_wise_fule_report_reports'
                )->get();


                $SalesPettyReportPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_petty_reports'
                )->get();

                $CreditCardReportPermissions = Permission::where(
                    'module_slug',
                    'manage_credit_card_reports'
                )->get();

                $SalesReportPermissions = Permission::where(
                    'module_slug',
                    'manage_sales_reports'
                )->get();

                $CreditCardReportByMonthReportPermissions = Permission::where(
                    'module_slug',
                    'manage_credit_card_report_by_month_reports'
                )->get();

                $GiftCardReportPermissions = Permission::where(
                    'module_slug',
                    'manage_gift_card_reports'
                )->get();

                 $GiftCardAllBranchReportPermissions = Permission::where(
                    'module_slug',
                    'manage_gift_cards_all_branch_reports'
                )->get();

                $MaintenanceReportPermissions = Permission::where(
                    'module_slug',
                    'manage_maintenance_reports'
                )->get();

                   $TipReportReportPermissions = Permission::where(
                    'module_slug',
                    'manage_tip_reports'
                )->get();


                $permissionPermissions = Permission::where(
                    'module_slug',
                    'manage_permission'
                )->get();

                $recycle_binPermissions = Permission::where(
                    'module_slug',
                    'recycle_bin'
                )->get();

                return view('admins.roles.role_permissions', [
                    'roles' => $roles,
                    'appUsersPermissions' => $appUsersPermissions,
                    'adminPermissions' => $adminPermissions,
                    'branchStaffPermissions' => $branchStaffPermissions,
                    'ManagementPermissions'=>$ManagementPermissions,
                    'branchManagerPermissions' => $branchManagerPermissions,
                    'branchPermissions' => $branchPermissions,
                    'branchLocalityPermissions' => $branchLocalityPermissions,
                    'menuCategoryPermissions' => $menuCategoryPermissions,
                    'menuItemPermissions' => $menuItemPermissions,
                    'menuItemAvailabilityPermissions' => $menuItemAvailabilityPermissions,
                    'cateringPermissions' => $cateringPermissions,
                    'CurrentOfferPermissions' => $CurrentOfferPermissions,
                    'offerPermissions' => $offerPermissions,
                    'discountPermissions' => $discountPermissions,
                    'couponPermissions' => $couponPermissions,
                    'giftCardPermissions' => $giftCardPermissions,
                    'loyaltyPermissions' => $loyaltyPermissions,
                    'blogPermissions' => $blogPermissions,
                    'orderPermissions' => $orderPermissions,
                    'transactionPermissions' => $transactionPermissions,
                    'websiteContentPermissions' => $websiteContentPermissions,
                    'bannerContentPermissions' => $bannerContentPermissions,
                    'MediaContentPermissions' => $MediaContentPermissions,
                    'ThemeContentPermissions' => $ThemeContentPermissions,
                    'SocialLinkContentPermissions' => $SocialLinkContentPermissions,
                    'contactUSPermissions' => $contactUSPermissions,
                    'reviewPermissions' => $reviewPermissions,
                    'joinusPermissions' => $joinusPermissions,
                     
                     'brandsPermissions'=>$brandsPermissions,
                     'subsidiariesPermissions'=>$subsidiariesPermissions,
                     'blocksPermissions'=>$blocksPermissions,

                    'cityPermissions' => $cityPermissions,
                    'questionPermissions' => $questionPermissions,
                    'designationsPermissions' => $designationsPermissions,
                    'PettyECatPermissions' => $PettyECatPermissions,
                    'PettyESubCatPermissions' => $PettyESubCatPermissions,
                    'MaintenanceCatPermissions' => $MaintenanceCatPermissions,
                    'MaintenanceSubCatPermissions' => $MaintenanceSubCatPermissions,
                    'ownershipPermissions' => $ownershipPermissions,
                    'driverPermissions' => $driverPermissions,
                    'carPermissions' => $carPermissions,
                    'rolesPermissions' => $rolesPermissions,
                    'reportsPermissions' => $reportsPermissions,
                    'CashDepositeReportsPermissions' => $CashDepositeReportsPermissions,
                    'DailySalesReportsPermissions' => $DailySalesReportsPermissions,
                    'PaymentMethodsBranchWisePermissions' => $PaymentMethodsBranchWisePermissions,
                    'SalesByBranchPermissions' => $SalesByBranchPermissions,
                    'SalesByBranchNetSalePermissions' => $SalesByBranchNetSalePermissions,
                     
                     'SalesByBranchGrossSaleMonthlyPermissions'=>$SalesByBranchGrossSaleMonthlyPermissions,
                     'SalesByBranchNetSaleMonthlyPermissions'=>$SalesByBranchNetSaleMonthlyPermissions,
 
                    'SalesByBranchDiscountSalePermissions' => $SalesByBranchDiscountSalePermissions,
                     'SalesByBranchDiscountComplementryReturnPermissions'=>$SalesByBranchDiscountComplemenrtyReturnPermissions,
                    'SalesByMonthPermissions' => $SalesByMonthPermissions,
                    'SalesByServicePermissions' => $SalesByServicePermissions,
                    'SalesByComplimentaryPermissions' => $SalesByComplimentaryPermissions,
                    'BranchPettyCashPermissions' => $BranchPettyCashPermissions,
                    'PettyByBranchPermissions' => $PettyByBranchPermissions,
                    'PettyByMonthPermissions' => $PettyByMonthPermissions,
                    'CarWiseFulePermissions' => $CarWiseFulePermissions,
                    'SalesPettyReportPermissions' => $SalesPettyReportPermissions,
                    'CreditCardReportPermissions' => $CreditCardReportPermissions,
                    'SalesReportPermissions' => $SalesReportPermissions,
                    'CreditCardReportByMonthReportPermissions' => $CreditCardReportByMonthReportPermissions,
                    'GiftCardReportPermissions' => $GiftCardReportPermissions,
                    'GiftCardAllBranchReportPermissions'=>$GiftCardAllBranchReportPermissions,
                    'MaintenanceReportPermissions' => $MaintenanceReportPermissions,
                    'TipReportReportPermissions' => $TipReportReportPermissions,
                    'permissionPermissions' => $permissionPermissions,
                    'recycle_binPermissions' => $recycle_binPermissions,
                ]);
            } else {
                return redirect()
                    ->route('add_role')
                    ->with(
                        'warning',
                        'No Roles Found! Please add a Role first.'
                    );
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function savePermissions(Request $request)
    {
        if (Auth::user()->can('edit_permissions')) {
            $role = Role::find($request->role_id);
            $updatePermissions = $role
                ->permissions()
                ->sync($request->permissions);
            if ($updatePermissions) {
                $roles = Role::where('id', '!=', 1)->get();
                return back()->with(
                    'success',
                    'Role Permissions Added successfully!'
                );
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Permanent Delete Role
     */
    public function permanentDeleteRole(Request $request)
    {
        $role = Role::where('id', $request->id)
            ->onlyTrashed()
            ->first();
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

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function deleteRole(Request $request)
    {
        $admin = Admin::where('role_id', $request->id)->first();
        if ($admin != null) {
            $res['success'] = 0;
            $res['message'] =
                "You cannot delete this record as it's being used.";
            return json_encode($res);
        } else {
            $role = Role::where('id', $request->id)->first();
            $role->permissionRoles()->delete();
            $role->admins()->delete();
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

    /**
     * This function is used to Show deleted Roles
     */
    public function deletedRoles()
    {
        if (Auth::user()->can('manage_recyle_role_tab')) {
            $deletedRoles = Role::onlyTrashed()
                ->orderByDesc('id')
                ->get();

            return view('admins.roles.deleted_roles_list', [
                'deletedRoles' => $deletedRoles,
            ]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Restore Roles
     */
    public function restoreRole(Request $request)
    {
        $role = Role::where('id', $request->id)
            ->onlyTrashed()
            ->first();
        $role->permissionRoles()->restore();
        $role->admins()->restore();
        $restoreRole = $role->restore();
        if ($restoreRole) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            $res['message'] = "Something went wrong! Please try again.";
            return json_encode($res);
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

/* start Old code Of Role Controller */

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Role;
// use App\Models\Permission;
// use App\Models\Admin;
// use Auth;

// class RolesController extends Controller
// {
//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function list(Request $request)
//     {
//         // if (Auth::user()->can('view_role')) {
//             $roles = Role::orderBy('name')
//                 ->where('id', '!=', 1)->where('tag','admin')
//                 ->get();
//             return view('admins.roles.list', ['roles' => $roles]);
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function view($id)
//     {
//         // if (Auth::user()->can('view_role')) {
//             $role = Role::find($id);
//             $permissions = \DB::table('permission_role')
//                 ->where('role_id', $role->id)
//                 ->get();
//             return view('admins.roles.view', [
//                 'role' => $role,
//                 'permissions' => $permissions
//             ]);
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function add(Request $request)
//     {
//         // if (Auth::user()->can('add_role')) {
//             return view('admins.roles.add');
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function save(Request $request)
//     {

//         // if (Auth::user()->can('edit_role')) {
//             $nameToLowercase = strtolower($request->role_name);
//             $roleTag = $name = str_replace(' ', '_', $nameToLowercase);
//             $roleType = $name = str_replace(' ', '_', $nameToLowercase);
//             $role = Role::where("tag", $roleTag)->get();
//             if (count($role) <= 0) {
//                 $role = new Role();
//                 $role->name = $request->role_name;
//                 $role->tag = $roleTag;
//                 $role->role_type = $roleType;
//                 $role->status = 1;
//                 if ($role->save()) {
//                     $roles = Role::where('id', '!=', 1)->get();
//                     return redirect()
//                         ->route('admins.role.list', ['roles' => $roles])
//                         ->with('success', 'Role Added successfully!');
//                 } else {
//                     return redirect()
//                         ->back()
//                         ->with('error', 'Something went wrong!');
//                 }
//             } else {
//                 $roles = Role::where('id', '!=', 1)->get();
//                 return redirect()
//                     ->route('admins.role.list', ['roles' => $roles])
//                     ->with(
//                         'error',
//                         'The Role already exists! Please edit the Role if you want to make any changes.'
//                     );
//             }
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function edit($id)
//     {
//         // if (Auth::user()->can('edit_role')) {
//             $role = Role::find($id);
//             return view('admins.roles.edit', [
//                 'role' => $role
//             ]);
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Update Role
//      */
//     public function update(Request $request)
//     {
//         // if (Auth::user()->can('edit_role')) {
//             $updateRole = Role::where('id', $request->id)->update([
//                 'name' => $request->name
//             ]);
//             if ($updateRole) {
//                 $roles = Role::orderByDesc('id')->get();
//                 return redirect()
//                     ->route('admins.role.list', ['roles' => $roles])
//                     ->with('success', 'Role Updated successfully!');
//             }
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function getRolePermissions(Request $request)
//     {
//         $rolePermissions = \DB::table('permission_role')
//             ->where('role_id', $request->role_id)
//             ->get();
//         return json_encode($rolePermissions);
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function permissions(Request $request)
//     {

//         // if (Auth::user()->can('view_permission')) {
//             $roles = Role::orderBy('name')
//                 ->where('id', '!=', 1)
//                 ->get();
//             if ($roles->isNotEmpty()) {
//                 $appUsersPermissions = Permission::where(
//                     'module_slug',
//                     'manage_customer'
//                 )->get();
//                 $adminPermissions = Permission::where(
//                     'module_slug',
//                     'manage_admin'
//                 )->get();
//                 $branchManagerPermissions = Permission::where(
//                     'module_slug',
//                     'manage_branch_manager'
//                 )->get();
//                 $branchPermissions = Permission::where(
//                     'module_slug',
//                     'manage_branch'
//                 )->get();

//                  $menuCategoryPermissions = Permission::where(
//                     'module_slug',
//                     'manage_menu_category'
//                 )->get();

//                  $menuItemPermissions = Permission::where(
//                     'module_slug',
//                     'manage_menu_item'
//                 )->get();

//                  $cateringPermissions = Permission::where(
//                     'module_slug',
//                     'manage_catering'
//                 )->get();

//                  $offerPermissions = Permission::where(
//                     'module_slug',
//                     'manage_offer'
//                 )->get();

//                  $loyaltyPermissions = Permission::where(
//                     'module_slug',
//                     'manage_loyalty'
//                 )->get();

//                  $blogPermissions = Permission::where(
//                     'module_slug',
//                     'manage_blog'
//                 )->get();

//                 $orderPermissions = Permission::where(
//                     'module_slug',
//                     'manage_order'
//                 )->get();
//                  $transactionPermissions = Permission::where(
//                     'module_slug',
//                     'payment_transaction'
//                 )->get();

//                 $websiteContentPermissions = Permission::where(
//                     'module_slug',
//                     'manage_website_content'
//                 )->get();

//                 $bannerContentPermissions = Permission::where(
//                     'module_slug',
//                     'manage_banner'
//                 )->get();

//                 $contactUSPermissions = Permission::where(
//                     'module_slug',
//                     'manage_contact_us'
//                 )->get();
//                 $reviewPermissions = Permission::where(
//                     'module_slug',
//                     'manage_review'
//                 )->get();
//                 $joinusPermissions = Permission::where(
//                     'module_slug',
//                     'manage_joinus'
//                 )->get();
//                 $cityPermissions = Permission::where(
//                     'module_slug',
//                     'manage_city'
//                 )->get();
//                 $rolesPermissions = Permission::where(
//                     'module_slug',
//                     'manage_roles'
//                 )->get();

//                 $permissionPermissions = Permission::where(
//                      'module_slug',
//                     'manage_permission'
//                 )->get();
//                 $recycle_binPermissions = Permission::where(
//                     'module_slug',
//                     'recycle_bin'
//                 )->get();

//                 return view('admins.roles.role_permissions', [
//                     'roles' => $roles,
//                     'appUsersPermissions' => $appUsersPermissions,
//                     'adminPermissions' => $adminPermissions,
//                     'branchManagerPermissions' => $branchManagerPermissions,
//                     'branchPermissions' => $branchPermissions,
//                     'menuCategoryPermissions'=>$menuCategoryPermissions,
//                     'menuItemPermissions'=>$menuItemPermissions,
//                     'cateringPermissions'=>$cateringPermissions,
//                     'offerPermissions' => $offerPermissions,
//                     'loyaltyPermissions' =>$loyaltyPermissions,
//                     'blogPermissions' => $blogPermissions,
//                     'orderPermissions' => $orderPermissions,
//                     'transactionPermissions' => $transactionPermissions,
//                     'websiteContentPermissions' => $websiteContentPermissions,
//                     'bannerContentPermissions' => $bannerContentPermissions,
//                     'contactUSPermissions' => $contactUSPermissions,
//                     'reviewPermissions' => $reviewPermissions,
//                      'joinusPermissions'=>$joinusPermissions,
//                     'cityPermissions' => $cityPermissions,
//                     'rolesPermissions' => $rolesPermissions,
//                     'permissionPermissions' => $permissionPermissions,
//                     'recycle_binPermissions' => $recycle_binPermissions
//                 ]);
//             } else {
//                 return redirect()
//                     ->route('add_role')
//                     ->with(
//                         'warning',
//                         'No Roles Found! Please add a Role first.'
//                     );
//             }
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function savePermissions(Request $request)
//     {
//         // if (Auth::user()->can('edit_permission')) {
//             $role = Role::find($request->role_id);
//             $updatePermissions = $role
//                 ->permissions()
//                 ->sync($request->permissions);
//             if ($updatePermissions) {
//                 $roles = Role::where('id', '!=', 1)->get();
//                 return back()->with(
//                     'success',
//                     'Role Permissions Added successfully!'
//                 );
//             } else {
//                 return redirect()
//                     ->back()
//                     ->with('error', 'Something went wrong!');
//             }
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Permanent Delete Role
//      */
//     public function permanentDeleteRole(Request $request)
//     {
//         $role = Role::where('id', $request->id)
//             ->onlyTrashed()
//             ->first();
//         $role->permissionRoles()->forceDelete();
//         $role->admins()->forceDelete();
//         $deleteRole = $role->forceDelete();
//         if ($deleteRole) {
//             $res['success'] = 1;
//             return json_encode($res);
//         } else {
//             $res['success'] = 0;
//             $res['message'] = "Something went wrong! Please try again.";
//             return json_encode($res);
//         }
//     }

//     /**
//      * This function is used to Show Saved Jobs Listing
//      */
//     public function deleteRole(Request $request)
//     {
//         $admin = Admin::where('role_id', $request->id)->first();
//         if ($admin != null) {
//             $res['success'] = 0;
//             $res['message'] =
//                 "You cannot delete this record as it's being used.";
//             return json_encode($res);
//         } else {
//             $role = Role::where('id', $request->id)->first();
//             $role->permissionRoles()->delete();
//             $role->admins()->delete();
//             $deleteRole = $role->delete();
//             if ($deleteRole) {
//                 $res['success'] = 1;
//                 return json_encode($res);
//             } else {
//                 $res['success'] = 0;
//                 $res['message'] = "Something went wrong! Please try again.";
//                 return json_encode($res);
//             }
//         }
//     }

//     /**
//      * This function is used to Show deleted Roles
//      */
//     public function deletedRoles()
//     {
//         // if (Auth::user()->can('view_deleted_role')) {
//             $deletedRoles = Role::onlyTrashed()
//                 ->orderByDesc('id')
//                 ->get();

//             return view('admins.roles.deleted_roles_list', [
//                 'deletedRoles' => $deletedRoles
//             ]);
//         // } else {
//         //     return redirect()
//         //         ->route('dashboard')
//         //         ->with(
//         //             'warning',
//         //             'You do not have permission for this action!'
//         //         );
//         // }
//     }

//     /**
//      * This function is used to Restore Roles
//      */
//     public function restoreRole(Request $request)
//     {
//         $role = Role::where('id', $request->id)
//             ->onlyTrashed()
//             ->first();
//         $role->permissionRoles()->restore();
//         $role->admins()->restore();
//         $restoreRole = $role->restore();
//         if ($restoreRole) {
//             $res['success'] = 1;
//             return json_encode($res);
//         } else {
//             $res['success'] = 0;
//             $res['message'] = "Something went wrong! Please try again.";
//             return json_encode($res);
//         }
//     }

//     public function getAllPermissions(Request $request)
//     {
//         $permissions = Permission::orderBy('name')->get();
//         for ($i = 0; $i < count($permissions); $i++) {
//             echo $permissions[$i]->id . ' : ' . $permissions[$i]->slug . "<br>";
//             echo "\n";
//         }
//     }

//     public function getUserPermissions(Request $request)
//     {
//         $user = $request->user();
//         $permissions = $user->role->permissions;
//         for ($i = 0; $i < count($permissions); $i++) {
//             echo $permissions[$i]->id . ' : ' . $permissions[$i]->slug . "<br>";
//             echo "\n";
//         }
//     }
// }

/* End Old Code of Role COntroller */
