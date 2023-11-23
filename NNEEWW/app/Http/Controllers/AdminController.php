<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Services\AdminServices;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    /**
     * This function is used to Show Admin Dashboard
     */
    public function dashboard(AdminServices $adminServices)
    {
        $dashboardData = $adminServices->dashboardIndex();

        //Monthly User

        $month_array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $month_val_data = array("January" => 0, "February" => 0, "March" => 0, "April" => 0, "May" => 0, "June" => 0, "July" => 0, "August" => 0, "September" => 0, "October" => 0, "November" => 0, "December" => 0);

        $now = \Carbon\Carbon::now();
        $today = $now->format('Y-m-d');

        $startOfMonth = $now->startOfMonth('Y-m-d')->format('Y-m-d');
        $endOfMonth = $now->endOfMonth()->format('Y-m-d');

        $monthlycond = User::select(
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->get()
            ->toArray();

        foreach ($month_val_data as $all_month_name => $all_month_value) {

            //for each real data......

            foreach ($monthlycond as $all_month_name_db => $all_month_value_db) {
                if ($all_month_name == $all_month_value_db['month_name']) {
                    $month_val_data[$all_month_name] = (int) $all_month_value_db['count'];
                }
            }

        }

        return view('dashboard', compact('month_val_data'))->with('data', $dashboardData);
    }

    /**
     * This function is used to Show Admin Profile
     */
    public function adminProfile(Request $request)
    {
        $userDetails = Admin::findOrFail(Auth::id());
        return view('admin_profile')->with('userDetails', $userDetails);
    }

    /**
     * This function is used to Update Admin Profile
     */
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required',
        ]);
        $updateProfile = Admin::where('id', $request->id)->update(['name' => $request->name]);
        if ($updateProfile) {
            return back()->with('success', 'Profile Updated Successfully!');
        } else {
            return back()->with('error', 'Something went wrong! Please try again later.');
        }
    }

    public function checkPassword(Request $request)
    {
        $passwordType = $request['password_type'];
        $admin = Admin::find(Auth::id());
        if ($passwordType == 'old') {
            if (Hash::check($request->password, $admin->password) == false) {
                return true;
            } else if (Hash::check($request->password, $admin->password) == true) {
                return false;
            }
        } else if ($passwordType == 'new') {
            if (Hash::check($request->password, $admin->password) == false) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * This function is used to Change Admin Password
     */
    public function changePassword(Request $request)
    {
        $changePassword = Admin::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);
        if ($changePassword) {
            return back()->with('success', 'Password Updated Successfully!');
        } else {
            return back()->with('error', 'Something went wrong! Please try again later.');
        }
    }

    public function setSession(Request $request)
    {
        Session::put('timezone', $request->timezone);
        return Session::get('timezone');
    }

}
