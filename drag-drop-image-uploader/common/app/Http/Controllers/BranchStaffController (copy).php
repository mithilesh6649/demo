<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\BranchStaf;
use App\Models\Branch;
use App\Models\Staff;
use App\Models\branchStaffs;

class BranchStaffController extends Controller
{

    public function CheckStaff(Request $request)
    {
        $branch=$request->branch_id;
        $staff_ids= branchStaffs::where('branch_id', $branch)->pluck('staff_id');

        $staff_det=Staff::whereIn('id',$staff_ids)->get();

        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();

        if (count($staff_det) == 0)
        {
            $result_view = view("branches.staff.add_partials", ["Alldesignation" => $Alldesignation, "count" => 0, ])->render();
        }

        if (count($staff_det) != 0)
        {
            $result_view = view("branches.staff.add_partials", ["Alldesignation" => $Alldesignation, "count" => 1, "staff_det" => $staff_det,'branch'=>$branch])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function addStaff()
    {

        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();
         //dd($Alldesignation);
        $result_view = view("branches.staff.add_partials", ["Alldesignation" => $Alldesignation, "count" => 3])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

//done
    public function saveStaff(Request $request)
    {

        branchStaffs::where('branch_id',$request->branch_id)->delete();
      
        foreach ($request->staff_code as $key => $value) {

           $branch_staff=new branchStaffs();
           $branch_staff->branch_id=$request->branch_id;
           $branch_staff->staff_id=Staff::where('staff_code',$value)->value('id');
           $branch_staff->start_date=date('Y-m-d');
           $branch_staff->save();        

        }

       return response()
            ->json(['success' => true]);

    }

    public function EditStaff(Request $request)
    {

        $CheckData = BranchStaf::where('branch_id', $request->branch_id)
            ->get();
        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();
        $Allbranch = Branch::orderBy('title_en')->where('status', '1')
            ->get();

        if (count($CheckData) == 0)
        {
            $result_view = view("branches.staff.edit_partials", ["Alldesignation" => $Alldesignation, "Allbranch" => $Allbranch, "count" => 0, ])->render();
        }

        if (count($CheckData) != 0)
        {
            $result_view = view("branches.staff.edit_partials", ["Alldesignation" => $Alldesignation, "count" => 1, "Allbranch" => $Allbranch, "CheckData" => $CheckData])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function updateStaff(Request $request)
    {
        //  dd($request->all());
        BranchStaf::where('branch_id', $request->branch_id_dynamic)
            ->delete();

        for ($i = 0;$i < count($request->staff_name);$i++)
        {

            $branchStaff = new BranchStaf();
            $branchStaff->branch_id = $request->branch_id[$i];
            $branchStaff->designation_id = $request->designation[$i];
            $branchStaff->staff_code = $request->staff_code[$i];
            $branchStaff->staff_name = $request->staff_name[$i];
            $branchStaff->point = $request->points[$i];
            $branchStaff->save();

        }

        return response()
            ->json(['success' => true]);

    }

    //change choice group status
    

    public function changeStaffStatus(Request $request)
    {
        //  dd($request->all());
        if ($request->status_value == 0)
        {
            $choiceGroupStatus = BranchStaf::where('id', $request->id)
                ->update(['status' => '0']);
            return response()
                ->json(['status' => 'group_inactive', 'message' => "Staff Inactive"]);
        }
        else
        {
            $choiceGroupStatus = BranchStaf::where('id', $request->id)
                ->update(['status' => '1']);
            return response()
                ->json(['status' => 'group_active', 'message' => "Staff Active"]);
        }

    }

    public function CheckStaffCode(Request $request){
            

       $staff_Det=Staff::with('designation_name')->where(['staff_code'=>$request->staff_code,'status'=>1])->first();
      
        if($staff_Det)
        {

           $dstaff=branchStaffs::where('staff_id',$staff_Det->id)->first();
           
            if($dstaff)
            {                 
            return response()->json([
                   'success'=>'false',
                   'data'=>null,
                   'msg'=>'Staff code already used'

                ]);
            }else{
                 return response()->json([
                   'success'=>'true',
                   'data'=>$staff_Det,

                ]);
            }
            
        }else
        {
            return response()->json([
                   'success'=>'false',
                   'data'=>null,
                   'msg'=>'Staff code not Found'
                   
                ]);
        }

    }

    public function deletedbrnachStaff(Request $request)
    {
      
        $delete_staff=branchStaffs::where(['branch_id'=>$request->branch_id,'staff_id'=>$request->staff_id])->first();

        if($delete_staff)
        {
            $delete_staff->delete();
            
             return response()->json([
                'success'=>'true',
                
              ]);
        }else
        {
            return response()->json([
                'success'=>'false',

              ]);
        }
    }

}

