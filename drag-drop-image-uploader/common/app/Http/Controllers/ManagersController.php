<?php

namespace App\Http\Controllers;

use App\Models\BranchManager;
use App\Models\BranchRole;
use App\Models\Role;
use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\User;

class ManagersController extends Controller
{
    public function managersList(Request $request)
    {
        if (Auth::user()->can('branch_managers_management')) {

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $block = DB::table('md_dropdowns')->where('slug', 'block_data')->get();
            $users = User::where('role_id', Role::where('role_type', 'manager')->value('id'))->orderBY('id', 'desc')->get();
            return view('branch-managers.branch-managers_list', compact('status', 'users', 'block'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function viewManager($id)
    {
        if (Auth::user()->can('view_branch_manager')) {
            $user = User::find($id);
            $roles = BranchRole::orderBy('created_at', 'DESC')
                ->where('status', '!=', 0)
                ->get();

            return view('branch-managers.view_manager', compact('user', 'roles'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function addManager()
    {
        if (Auth::user()->can('add_branch_manager')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $block = DB::table('md_dropdowns')->where('slug', 'block_data')->get();
            $roles = BranchRole::orderBy('created_at', 'DESC')
                ->where('status', '!=', 0)
                ->get();

            return view('branch-managers.add_manager', compact('status', 'block', 'roles'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function saveManager(Request $request)
    {

        $image = null;

        if ($request->file("image")) {
            $ManagerImage = $request->file("image");
            $image =
            time() . "." . $ManagerImage->getClientOriginalExtension();
            $ManagerImage->move("branch_managers_profile", $image);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->country = $request->country_code;
        $user->role_id = Role::where('role_type', 'manager')->value('id');
        $user->branch_role_id = $request->branch_role_id;
        $user->status = $request->status;
        $user->is_user_locked = $request->is_user_locked;
        $user->password = \Hash::make($request->password);

        $user->image = $image;

        if ($user->save()) {
            return redirect()->route('managers_list')->with('success', 'Branch Manager has been added successfully!');
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function blockManager(Request $request)
    {

        if ($request->status_value == 1) {
            $user = User::where('id', $request->id)->first();
            $user->is_user_locked = '1';
            $user->save();
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $user = user::where('id', $request->id)->first();
            $user->is_user_locked = '0';
            $user->save();
            $res['success'] = 0;
            return json_encode($res);

        }

    }

    public function deleteManager(Request $request)
    {

        $user = User::where('id', $request->id)->each(function ($user) {

            // first child
            BranchManager::where('user_id', $user->id)->each(function ($BranchManager) {
                $BranchManager->delete();
            });

            //Final Parent Element
            $user->delete();

        });

        // $deleteUser = User::where("id", $request->id)->delete();
        if ($user) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

        // $deleteUser = User::where('id', $request->id)->delete();
        // if ($deleteUser) {
        //     $res['success'] = 1;
        //     return json_encode($res);
        // } else {
        //     $res['success'] = 0;
        //     return json_encode($res);
        // }
    }

    public function editManager($id)
    {
        if (Auth::user()->can('edit_branch_manager')) {
            $user = User::find($id);
            $roles = BranchRole::orderBy('created_at', 'DESC')
                ->where('status', '!=', 0)
                ->get();

            return view('branch-managers.edit_manager', compact('user', 'roles'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function updateManager(Request $request)
    {

        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->country = $request->country_code;
        $user->status = $request->status;
        $user->is_user_locked = $request->is_user_locked;
        $user->branch_role_id = $request->branch_role_id;
        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }

        if ($request->file("image")) {
            $ManagerImage = $request->file("image");
            $image = rand() . time() . "." . $ManagerImage->getClientOriginalExtension();
            $ManagerImage->move("branch_managers_profile", $image);
            $user->image = $image;
        }

        if ($user->save()) {
            return redirect()->route('managers_list')->with(['success' => 'Branch Manager details has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }
    }

    public function checkManagerEmail(Request $request)
    {
        $email = User::withTrashed()->where('email', $request->email)->get();
        if (count($email) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }
    }

    public function changeManagerStatus(Request $request)
    {
        if ($request->status_value == 1) {
            $user = User::where('id', $request->id)->first();
            $user->status = '1';
            $user->save();
            return response()->json(['status' => 'manager_locked', 'message' => "Manager Locked"]);
        } else {
            $user = user::where('id', $request->id)->first();
            $user->status = '0';
            $user->save();
            return response()->json(['status' => 'manager_unlocked', 'message' => "Manager Unlocked"]);

        }

    }

    //deletedUsersList
    public function deletedManagersList()
    {

        if (Auth::user()->can("manage_recyle_branch_manager_tab")) {

            $usersList = User::where('role_id', Role::where('role_type', 'manager')->value('id'))->orderBY('id', 'desc')->onlyTrashed()->get();
            //dd($usersList);
            return view('branch-managers.deleted_managers_list', compact('usersList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    //Restore User
    public function restoreManager(Request $request)
    {
        // $usersList = User::withTrashed()->find($request->id)->restore();
        // return "success";

        $user = User::where('id', $request->id)->withTrashed()->each(function ($user) {

            // first child
            BranchManager::where('user_id', $user->id)->withTrashed()->each(function ($BranchManager) {
                $BranchManager->restore();
            });

            //Final Parent Element
            $user->restore();

        });

        // $deleteUser = User::where("id", $request->id)->delete();
        if ($user) {
            return "success";
        }

    }

    //Permanent Delete User
    public function permanentDeleteManager(Request $request)
    {
        // $usersList = User::onlyTrashed()->find($request->id)->forceDelete();
        // return "success";

        $user = User::where('id', $request->id)->onlyTrashed()->each(function ($user) {

            // first child
            BranchManager::where('user_id', $user->id)->onlyTrashed()->each(function ($BranchManager) {
                $BranchManager->forceDelete();
            });

            //Final Parent Element
            $user->forceDelete();

        });

        // $deleteUser = User::where("id", $request->id)->delete();
        if ($user) {
            return "success";
        }

    }

    //Remove Manager Image

    public function RemoveManagerImage(Request $request)
    {

        $branchManager = User::where(
            'id',
            $request->manager_id
        )->first();

        if ($branchManager) {
            $branchManager->image = null;
            if ($branchManager->save()) {
                return response()->json(['status' => 'true', 'success' => 1]);
            } else {
                return response()->json(['status' => 'true', 'success' => 0]);
            }
        } else {
            return response()->json(['status' => 'true', 'success' => 0]);
        }

    }

}
