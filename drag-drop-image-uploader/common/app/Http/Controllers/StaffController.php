<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\branchStaffs;
use \App\Models\Designation;
use \App\Models\Staff;
use \App\Models\staffpromotionhistory;
use App\Models\StaffLeave;
class StaffController extends Controller
{
    public function staffList(Request $request)
    {
        if (Auth::user()->can('branch_staff_management')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $staffs = Staff::with('branchStaffs:staff_id,branch_id', 'branchStaffs.StaffBranch')->orderBY('id', 'desc')->get();

            return view('staff.staff_list', compact('staffs', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function viewStaff($id)
    {
        if (Auth::user()->can('view_branch_staff')) {
            $staff = Staff::find($id);
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
           
             //For  Branch Staff Histoty


             //For  Staff Leaves Histoty

             //Get Staff Leave Details 
             $staffLeaveHistory =   StaffLeave::with('branch','staff')->where('staff_id',$id)->get();

              $branchStaffHistory = branchStaffs::with('Staff','StaffBranch')->where('staff_id', $id)->get();

             // dd($branchStaffHistory);

              return view('staff.staff_view', compact('staff', 'status','branchStaffHistory','staffLeaveHistory'));


        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function addStaff()
    {
        if (Auth::user()->can('add_branch_staff')) {
            $designation_list = Designation::where('status', '1')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('staff.staff_add', compact('designation_list', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function saveStaff(Request $request)
    {

        $staff = new Staff;
        $staff->staff_name = $request->staff_name;
        $staff->staff_code = $request->staff_code;
        $staff->designation_id = $request->designation;
        $staff->civil_id = $request->civil_id;
        $staff->status = $request->status;

        if ($request->points != null && $request->points != '') {
            $staff->points = $request->points;
        }

        if ($staff->save()) {
            return redirect()->route('staff_list')->with('success', 'Staff has been added successfully!');
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function deleteStaff(Request $request)
    {

        $b_sf = 1;
        $branch_staff = Staff::where('id', $request->id)->each(function ($branch_staff) {

            // first child

            branchStaffs::where('staff_id', $branch_staff->id)->each(function ($b_staff) {
                $b_staff->delete();
            });

            staffpromotionhistory::where('staff_id', $branch_staff->id)->each(function ($b_staff_staffpromotionhistory) {
                $b_staff_staffpromotionhistory->delete();
            });

            $b_sf = $branch_staff->delete();

        });

        if ($b_sf) {
            \Session::flash('status', 'Staff Deleted Successfully!');
            \Session::flash('class', 'alert-danger');
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

        // $deleteStaff = Staff::where('id', $request->id)->delete();
        // if ($deleteStaff) {
        //     \Session::flash('status', 'Staff Deleted Successfully!');
        //     \Session::flash('class', 'alert-danger');
        //     $res['success'] = 1;
        //     return json_encode($res);
        // } else {
        //     $res['success'] = 0;
        //     return json_encode($res);
        // }
    }

    public function editStaff($id)
    {
        if (Auth::user()->can('edit_branch_staff')) {
            $staff = Staff::find($id);
            $designation_list = Designation::where('status', '1')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            //Get Staff Leave Details

            $staffLeaveHistory =   StaffLeave::with('branch','staff')->where('staff_id',$id)->get();

              $staffLeavelatest =   StaffLeave::where('staff_id',$id)->orderByDesc('created_at')->get();
             // dd($staffLeavelatest);
            // dd($staffLeaveHistory);
            return view('staff.staff_edit', compact('staff', 'designation_list', 'status','staffLeaveHistory'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function updateStaff(Request $request)
    {

        $staff = Staff::find($request->id);
        $staff->staff_name = $request->staff_name;
        $staff->staff_code = $request->staff_code;
        $staff->designation_id = $request->designation;
        $staff->civil_id = $request->civil_id;
        $staff->status = $request->status;

        if ($request->points != null && $request->points != '') {
            $staff->points = $request->points;
        }

        if ($staff->save()) {
            return redirect()->route('staff_list')->with(['success' => 'Staff details has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }
    }

    public function checkstaffcode(Request $request)
    {

        if ($request->has('id')) {
            $data = Staff::where(['staff_code' => $request->staff_code])->where('id', '!=', $request->id)->get();
        } else {
            $data = Staff::where(['staff_code' => $request->staff_code])->get();
        }

        if (count($data) > 0) {
            return response()->json(['msg' => 'true']);
        } else {
            return response()->json(['msg' => 'false']);
        }

    }

    //deletedUsersList
    public function deletedStaffsList()
    {
        if (Auth::user()->can("manage_recyle_staff_tab")) {

            $staffsList = Staff::orderBY("id", "desc")
                ->onlyTrashed()
                ->get();
            //dd($staffsList);
            return view("staff.deleted_staffs_list", compact("staffsList"));

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
    public function restoreStaff(Request $request)
    {
        //dd($request->all());
        $branch_staff = Staff::where('id', $request->id)->withTrashed()->each(function ($branch_staff) {

            // first child

            branchStaffs::where('staff_id', $branch_staff->id)->withTrashed()->each(function ($b_staff) {
                $b_staff->restore();
            });

            staffpromotionhistory::where('staff_id', $branch_staff->id)->withTrashed()->each(function ($b_staff_staffpromotionhistory) {
                $b_staff_staffpromotionhistory->restore();
            });

            $branch_staff->restore();

        });

        return "success";
        // $usersList = Staff::withTrashed()
        //     ->find($request->id)
        //     ->restore();
        // return "success";
    }

    //Permanent Delete User
    public function permanentDeleteStaff(Request $request)
    {

        $branch_staff = Staff::where('id', $request->id)->onlyTrashed()->each(function ($branch_staff) {

            // first child

            branchStaffs::where('staff_id', $branch_staff->id)->onlyTrashed()->each(function ($b_staff) {
                $b_staff->forceDelete();
            });

            staffpromotionhistory::where('staff_id', $branch_staff->id)->onlyTrashed()->each(function ($b_staff_staffpromotionhistory) {
                $b_staff_staffpromotionhistory->forceDelete();
            });

            $branch_staff->forceDelete();

        });

        return "success";

        // $usersList = Staff::onlyTrashed()
        //     ->find($request->id)
        //     ->forceDelete();
        // return "success";
    }

}
