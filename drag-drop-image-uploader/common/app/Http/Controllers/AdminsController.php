<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Session;

class AdminsController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:recruiters'],
            'role' => ['required'],
        ]);
    }
    /**
     * This function is used to Show Admins Listing
     */
    public function adminsList(Request $request)
    {
        if (Auth::user()->can('admins_management')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $admin_list = Admin::where('role_id', '!=', 1)->orderBy('created_at', 'DESC')->get();
            return view('admins/admins_list', compact('admin_list', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Admins Listing
     */
    public function addAdmin(Request $request)
    {
        if (Auth::user()->can('add_admin')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $roles = Role::orderBy('name')
                ->where('role_type', 'admin')
                ->get();
            return view('admins/add_admin', compact('roles', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Admins Listing
     */
    public function saveAdmin(Request $request)
    {

        $admin = new Admin;

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->status = $request->status;
        $admin->role_id = $request->role_id;
        $admin->password = Hash::make($request->password);
        if ($admin->save()) {
            return redirect()->route('admin_list', ['admin' => $admin])->with('success', 'Admin has been added successfully!  ');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        return view('admins/add_admin');
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function viewAdmin($id)
    {
        if (Auth::user()->can('view_admin')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $admin = Admin::where('id', $id)->first();
            $roles = Role::orderBy('name')
                ->where('id', '!=', 1)
                ->get();
            return view('admins/view_admin', compact('admin', 'roles', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Admins Listing
     */
    public function editAdmin($id)
    {
        if (Auth::user()->can('edit_admin')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $admin = Admin::where('id', $id)->first();
            $roles = Role::orderBy('name')
                ->where('role_type', 'admin')
                ->get();
            return view('admins/edit_admin', compact('admin', 'roles', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Admins Listing
     */
    public function updateAdmin(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ], [
            'first_name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'role_id.required' => 'Role is required',
        ]);
        $updateAdmin = Admin::where('id', $request->id)->first();
        $updateAdmin->first_name = $request->first_name;
        $updateAdmin->last_name = $request->last_name;
        $updateAdmin->role_id = $request->role_id;
        $updateAdmin->status = $request->is_user_locked;
        $updateAdmin->save();
        if ($request->has('password') && $request->has('confirm_password')) {

            if (!empty($request->password) && !empty($request->confirm_password)) {

                if ($request->password == $request->confirm_password) {

                    $updateAdmin = Admin::where('id', $request->id)->update([
                        'password' => Hash::make($request->password),
                    ]);
                } else {
                    return back()->with('error', "The password confirmation does not match.");
                }
            } elseif (!empty($request->password) && empty($request->confirm_password)) {
                return back()->with('error', "The password confirmation does not match.");
            } elseif (empty($request->password) && !empty($request->confirm_password)) {
                return back()->with('error', "The password confirmation does not match.");
            }
        }

        if ($updateAdmin) {
            $adminsList = Admin::where('role_id', '!=', 1)->get();
            return redirect()->route('admin_list', ['adminsList' => $adminsList])->with('success', "Admin  details has been updated successfully!");
        } else {
            return back()->with('error', "Something went wrong! Please try again.");
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function deleteAdmin(Request $request)
    {
        $deleteAdmin = Admin::where('id', $request->id)->delete();
        if ($deleteAdmin) {
            Session::flash('status', 'Admin Deleted Successfully!');
            Session::flash('class', 'alert-danger');
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    public function checkIfEmailExist(Request $request)
    {

        $email = Admin::withTrashed()->where('email', $request->email)->get();
        if (count($email) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }

    }

    public function changeAdminStatus(Request $request)
    {

        if ($request->status_value == 0) {
            $admin = Admin::where('id', $request->id)->first();
            $admin->is_user_locked = '1';
            $admin->save();
            return response()->json(['status' => 'admin_locked', 'message' => "Admin Locked"]);
        } else {
            $admin = Admin::where('id', $request->id)->first();
            $admin->is_user_locked = '0';
            $admin->save();
            return response()->json(['status' => 'admin_unlocked', 'message' => "Admin Unlocked"]);

        }

    }

    public function permissions()
    {
        return view('admins.permissions');
    }

    //Deleted Admins List
    public function deletedAdminsList()
    {

        if (Auth::user()->can('manage_recyle_admin_tab')) {

            $adminsList = Admin::onlyTrashed()->get();
            return view('admins.deleted_admins_list', compact('adminsList'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }
    //Restore Deleted Admin
    public function restoreAdmin(Request $request)
    {
        $adminsList = Admin::withTrashed()->find($request->id)->restore();
        return "success";
    }
    //Permanent Delete Admin
    public function permanentDeleteAdmin(Request $request)
    {
        $AdminList = Admin::onlyTrashed()->find($request->id)->forceDelete();
        return "success";
    }

}
