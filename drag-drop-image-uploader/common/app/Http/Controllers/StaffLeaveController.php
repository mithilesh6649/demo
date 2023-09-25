<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffLeave;
use  App\Models\branchStaffs;
use  App\Models\Designation;
use  App\Models\Staff; 
class StaffLeaveController extends Controller
{
       

    public function saveStaffLeave(Request $request){
       //    dd($request->all());
            $staffLeave  = new StaffLeave() ;
          

           //Leave Start Date 
        $start_leave_date=str_replace("/","-",$request->start_leave_date);
       // dump($start_leave_date);
        $start_leave_date =date('Y-m-d',strtotime($start_leave_date));
         //dump($start_leave_date);
         //Leave End Date
        $end_leave_date = str_replace("/","-",$request->end_leave_date);
         //dump($end_leave_date);
        $end_leave_date = date('Y-m-d',strtotime($end_leave_date));
         
        //dd($end_leave_date);
       
        //get branch id
       $CheckBranchStaffData = branchStaffs::where('staff_id', $request->id)->whereNull('end_date')->first();
    

       $staffLeave->staff_id = $request->id ;
       $staffLeave->branch_id =  $CheckBranchStaffData->branch_id;
       $staffLeave->leave_type = '0';
       $staffLeave->start_leave_date = $start_leave_date ;
       $staffLeave->end_leave_date = $end_leave_date ;
       $staffLeave->reason = $request->reason ;
       $staffLeave->save();

        return redirect()
            ->back()
            ->with(["success" => "Staff Leave added successfully !"]);



    } 


    public function deletestaffLeave(Request $request){

     $deletestaffLeave = StaffLeave::where("id", $request->id)
            ->forceDelete();
        if ($deletestaffLeave) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }


    }


    public function updatestaffLeave(Request $request){


            //Leave Start Date 
        $start_leave_date=str_replace("/","-",$request->start_leave_date);
        $start_leave_date =date('Y-m-d',strtotime($start_leave_date));
        $end_leave_date = str_replace("/","-",$request->end_leave_date);
        $end_leave_date = date('Y-m-d',strtotime($end_leave_date));
          //get branch id
        $CheckBranchStaffData = branchStaffs::where('staff_id', $request->id)->whereNull('end_date')->first();
  

         $staffLeave = StaffLeave::where('id',$request->current_leave_id)->first();
         $staffLeave->branch_id =  $CheckBranchStaffData->branch_id;
         $staffLeave->leave_type = '0';
         $staffLeave->start_leave_date = $start_leave_date ;
         $staffLeave->end_leave_date = $end_leave_date ;
         $staffLeave->reason = $request->reason ;
         $staffLeave->update();
         
         return redirect()
            ->back()
            ->with(["success" => "Staff Leave Updated successfully !"]);
    }

}
