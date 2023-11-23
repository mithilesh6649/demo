<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;use Silamoney\Client\Domain\User;

class AdminsController extends Controller
{

    /**
     * This function is used to Check if the email exists in the table
     */
    public function checkEmail(Request $request)
    {
        $tableName = 'admins';
        if (isset($_GET['id'])) {
            $emailExists = DB::table($tableName)->where('email', $_GET['email'])->where('id', '!=', $_GET['id'])->get();
            if ($emailExists->isNotEmpty()) {
                return true;
            } else {
                return false;
            }
            exit;
        } else {
            $emailExists = DB::table($tableName)->where('email', $request->email)->first();
            if ($emailExists && $emailExists != null) {
                return 'false';
            } else {
                return 'true';
            }
            exit;
        }
    }
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
        if (Auth::user()->can('admin_management')) {
            $adminsList = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->orderBy('email')->get();
            return view('admins/admins_list', ['adminsList' => $adminsList]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    // filter
    public function filter(Request $request)
    {
        $date_range = $request->date_range;

        if ($request->reset) {
            $adminsList = $adminsList = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->orderBy('email')->get();
        } else {
            $adminsList = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->orderBy('email')->where('created_at', '>=', date('Y-m-d', strtotime($date_range[0])))->where('created_at', '<=', date('Y-m-d', strtotime($date_range[1])))->get();
        }

        // test
        $result_view = view('admins.partial', ['adminsList' => $adminsList])->render();
        return json_encode(['html' => $result_view, 'status' => true]);
    }
    // filter

    /**
     * This function is used to Show Admins Listing
     */
    public function addAdmin(Request $request)
    {
        if (Auth::user()->can('add_admin')) {
            $roles = Role::orderBy('name')->where('role_type', 'admins')->get();
            return view('admins/add_admin', ['roles' => $roles]);
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
        $admin->full_name = $request->full_name;
        $admin->email = $request->email;
        $admin->role_id = $request->role_id;
        $admin->status = $request->status;
        $admin->password = Hash::make($request->password);
        $admin->qualification = $request->qualification;
          if ($request->file("image")) {
            $adminImage = $request->file("image");
            $thumbnail = time() . "." . $adminImage->getClientOriginalExtension();
            $adminImage->move("images/admin", $thumbnail);
            $admin->image = env('IMAGE_BASE_URL') . '/images/admin/' . $thumbnail;
        }
        if ($admin->save()) {
            return redirect()->route('admins_list', ['admin' => $admin])->with('success', 'Admin Creaed Successfully!');
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
            $viewAdmin = Admin::where('id', $id)->get();
            $deletedAdmins = Admin::onlyTrashed()->get();
            if ($viewAdmin->isNotEmpty()) {
                return view('admins/view_admin', ['viewAdmin' => $viewAdmin]);
            } else {
                return view('admins/view_admin', ['viewAdmin' => $deletedAdmins]);
            }
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function deleteAdminProfile(Request $request){
        $adminData = Admin::where(
        'id',
        $request->admin_id
    )->first();

    if ($adminData) {
        $adminData->image = null;
        if ($adminData->save()) {
            return response()->json(['status' => 'true', 'success' => 1]);
        } else {
            return response()->json(['status' => 'true', 'success' => 0]);
        }
    } else {
        return response()->json(['status' => 'true', 'success' => 0]);
    }
    }

    /**
     * This function is used to Show Admins Listing
     */
    public function editAdmin($id)
    {
        if (Auth::user()->can('edit_admin')) {
            // $roles = Role::orderBy('name')->where('id', '!=', 1)->get();
            $roles = Role::orderBy('name')->where('role_type', 'admins')->get();
            $admin = Admin::find($id);
            return view('admins/edit_admin', ['roles' => $roles, 'admin' => $admin]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    /**
     * This function is used to Show Admins Listing
     */
    public function updateAdmin(Request $request)
    {

        // $validatedData = $request->validate([
        //     'full_name' => 'required',
        //     'email' => 'required|email',
        //     'role_id' => 'required',
        //     'is_enable' => 'required',
        // ], [
        //     'full_name.required' => 'Name is required',
        //     'email.required' => 'Email is required',
        //     'email.email' => 'Email is not valid',
        //     'role_id.required' => 'Role is required',
        //     'is_enable.required' => 'Is Enabled is required',
        // ]);

          if ($request->file("image")) {
            $adminImage = $request->file("image");
            $thumbnail = time() . "." . $adminImage->getClientOriginalExtension();
            $adminImage->move("images/admin", $thumbnail);
            $admin = Admin::where('id', $request->id)->first();
            $admin->image = env('IMAGE_BASE_URL') . '/images/admin/' . $thumbnail;
            $admin->update();
          }
        $updateAdmin = Admin::where('id', $request->id)->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'qualification' => $request->qualification,
            'status' => $request->status,
        ]);
        if ($updateAdmin || $admin ) {
            $adminsList = Admin::where('role_id', '!=', 1)->get();
            return redirect()->route('admins_list', ['adminsList' => $adminsList])->with('success', "Admin Updated Successfully!");
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
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    public function deleteAdminPermanantly(Request $request)
    {
        $deleteAdmin = Admin::where('id', $request->id)->forceDelete();
        if ($deleteAdmin) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

}
