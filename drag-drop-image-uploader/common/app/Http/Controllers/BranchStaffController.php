<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchStaf;
use App\Models\branchStaffs;
use App\Models\Designation;
use App\Models\Staff;
use App\Models\StaffLeave;
use Illuminate\Http\Request;

class BranchStaffController extends Controller
{

    public function CheckStaff(Request $request)
    {

        $CheckData = branchStaffs::with('Staff')->where('branch_id', $request->branch_id)->whereNull('end_date')
            ->get();

        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();

        if (count($CheckData) == 0) {
            $result_view = view("branches.staff.add_partials", ["Alldesignation" => $Alldesignation, "count" => 0])->render();
        }

        if (count($CheckData) != 0) {
            $result_view = view("branches.staff.add_partials", ["Alldesignation" => $Alldesignation, "count" => 1, "CheckData" => $CheckData])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function CheckStaffCode(Request $request)
    {
        $suffix_code = '';

        // dd($request->all());
        //Add suffix

        $SearchedStaffCode = Staff::where('staff_code', $request->code)->where('status', 1)->first();
        if (!empty($SearchedStaffCode)) {
            $suffix_code = $request->code;
        } else {
            $mystring = $request->code;
            $findme = 'MM';
            $pos = strpos($mystring, $findme);

            // Note our use of ===.  Simply == would not work as expected
            // because the position of 'a' was the 0th (first) character.
            if ($pos === false) {
                $suffix_code = "MM" . $request->code;
            } else {
                $suffix_code = $request->code;
            }

        }

        // dd($suffix_code);

        //Get Staff
        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();
        $SearchedStaff = Staff::where('staff_code', $suffix_code)->where('status', 1)->first();
        if (!empty($SearchedStaff)) {
            $SearchedStaffParentId = $SearchedStaff->id;

            $CheckBranchStaffData = branchStaffs::where('staff_id', $SearchedStaffParentId)->whereNull('end_date')->first();
            $designations = Designation::where('id', $SearchedStaff->designation_id)->value('designation');
            if (empty($CheckBranchStaffData)) {

                return response()->json([
                    'status' => '2',
                    'message' => "Staff found",
                    'data' => $SearchedStaff,
                    'designation' => $designations,
                    'suffix_code' => $suffix_code,
                ]);

            } else {
                return response()->json([
                    'status' => '1',
                    'message' => "Staff already allocated",
                ]);
            }

        } else {
            return response()->json([
                'status' => '0',
                'message' => "Staff code not found",
            ]);
        }

        //  dd($SearchedStaff);
        // dd($request->all());
        //    $staff_ids= branchStaffs::where('branch_id', $branch)->pluck('staff_id');

    }

    public function addStaff()
    {

        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();
        // dd($Alldesignation);
        $result_view = view("branches.staff.add_partials", ["Alldesignation" => $Alldesignation, "count" => 3])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function saveStaff(Request $request)
    {
        //  dump($request->all());

        $CheckData = branchStaffs::where('branch_id', $request->branch_id)->whereNull('end_date')
            ->get();

        if (count($CheckData) != 0) {
            $AllStaffIds = branchStaffs::where('branch_id', $request->branch_id)->whereNull('end_date')
                ->pluck('staff_id')->toArray();
            // dump($AllStaffIds);

            foreach ($request->staff_code as $key => $value) {

                $values = Staff::where('staff_code', $value)->value('id');
                // dd($values);
                if (!in_array($values, $AllStaffIds)) {
                    //  dd($values);
                    $dates = str_replace("/", "-", $request->start_date[$key]);
                    $start_date = date('Y-m-d H:m:s', strtotime($dates));
                    $branch_staff = new branchStaffs();
                    $branch_staff->branch_id = $request->branch_id;
                    $branch_staff->staff_id = $values;
                    $branch_staff->start_date = $start_date;
                    $branch_staff->save();
                }

            }

            return response()
                ->json(['success' => true]);

        } else {

            foreach ($request->staff_code as $key => $value) {

                $dates = str_replace("/", "-", $request->start_date[$key]);
                $start_date = date('Y-m-d H:m:s', strtotime($dates));

                $branch_staff = new branchStaffs();
                $branch_staff->branch_id = $request->branch_id;
                $branch_staff->staff_id = Staff::where('staff_code', $value)->value('id');
                $branch_staff->start_date = $start_date;
                $branch_staff->save();

            }

            return response()
                ->json(['success' => true]);

        }

    }

    public function deletedbrnachStaff(Request $request)
    {

        $delete_staff = branchStaffs::where(['branch_id' => $request->branch_id, 'staff_id' => $request->staff_id])->whereNull('end_date')->first();
        $delete_staff->end_date = date('Y-m-d');
        if ($delete_staff->update()) {
            //$delete_staff->delete();

            return response()->json([
                'success' => 'true',
            ]);
        } else {
            return response()->json([
                'success' => 'false',

            ]);
        }
    }

    public function EditStaff(Request $request)
    {

        $CheckData = branchStaffs::with('Staff')->where('branch_id', $request->branch_id)->whereNull('end_date')
            ->get();
        $Alldesignation = Designation::orderBy('designation')->where('status', '1')
            ->get();
        $Allbranch = Branch::orderBy('title_en')->where('status', '1')
            ->get();

        if (count($CheckData) == 0) {
            $result_view = view("branches.staff.edit_partials", ["Alldesignation" => $Alldesignation, "Allbranch" => $Allbranch, "count" => 0])->render();
        }

        if (count($CheckData) != 0) {
            $result_view = view("branches.staff.edit_partials", ["Alldesignation" => $Alldesignation, "count" => 1, "Allbranch" => $Allbranch, "CheckData" => $CheckData])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function updateStaff(Request $request)
    {

        // dd($request->all());

        for ($i = 0; $i < count($request->staff_name); $i++) {

            $datess = str_replace("/", "-", $request->start_date[$i]);
            $end_date_cal = date('Y-m-d H:m:s', strtotime($datess));
            $final_end_date = date('Y-m-d', strtotime('-1 day', strtotime($end_date_cal)));
            // $findStaff = branchStaffs::where('staff_id', $request->staff_code[$i])->whereNull('end_date')
            // ->first();
            $findStaff = branchStaffs::where('staff_id', Staff::where('staff_code', $request->staff_code[$i])->value('id'))->whereNull('end_date')
                ->first();

            if ($findStaff) {

                if ($findStaff->branch_id != $request->branch_id[$i]) {

                    $findStaff->end_date = $final_end_date;
                    if ($findStaff->update()) {

                        $dates = str_replace("/", "-", $request->start_date[$i]);
                        $start_date = date('Y-m-d H:m:s', strtotime($dates));
                        $branch_staff = new branchStaffs();
                        $branch_staff->branch_id = $request->branch_id[$i];
                        $branch_staff->staff_id = Staff::where('staff_code', $request->staff_code[$i])->value('id');
                        $branch_staff->start_date = $start_date;
                        $branch_staff->save();

                    }
                }

                if ($findStaff->branch_id == $request->branch_id[$i]) {
                    //dump($findStaff->start_date);
                    $datesmk = str_replace("/", "-", $request->start_date[$i]);
                    $start_datemk = date('Y-m-d ', strtotime($datesmk));
                    // dd($start_datemk);
                    if ($findStaff->start_date != $start_datemk) {
                        $findStaff->start_date = $start_datemk;
                        $findStaff->update();
                    }

                }

            }

        }

        return response()
            ->json(['success' => true]);
// dd($request->all());

        // BranchStaf::where('branch_id', $request->branch_id_dynamic)
        //     ->delete();

        // for ($i = 0;$i < count($request->staff_name);$i++)
        // {

        //     $branchStaff = new BranchStaf();
        //     $branchStaff->branch_id = $request->branch_id[$i];
        //     $branchStaff->designation_id = $request->designation[$i];
        //     $branchStaff->staff_code = $request->staff_code[$i];
        //     $branchStaff->staff_name = $request->staff_name[$i];
        //     $branchStaff->point = $request->points[$i];
        //     $branchStaff->save();

        // }

        // return response()
        //     ->json(['success' => true]);

    }

    //change choice group status

    public function changeStaffStatus(Request $request)
    {
        //  dd($request->all());
        if ($request->status_value == 0) {
            $choiceGroupStatus = BranchStaf::where('id', $request->id)
                ->update(['status' => '0']);
            return response()
                ->json(['status' => 'group_inactive', 'message' => "Staff Inactive"]);
        } else {
            $choiceGroupStatus = BranchStaf::where('id', $request->id)
                ->update(['status' => '1']);
            return response()
                ->json(['status' => 'group_active', 'message' => "Staff Active"]);
        }

    }

    public function importBranchStaffs()
    {

        // Staff::truncate();
        // branchStaffs::truncate();

        if (($handle = fopen(public_path() . '/staffdetails.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // dump($data[0]);
                //  dump($data[1]);
                //  dump($data[2]);
                //  dump($data[3]);
                //    dump($data[4]);
                // dd('sdf');

                Staff::create([
                    'staff_name' => $data[2],
                    'staff_code' => $data[0],
                    //   'designation_id'=>Designation::where('designation','LIKE','%'.$data[3].'%')->value('id'),
                    'designation_id' => Designation::where('designation', $data[3])->value('id'),
                    'civil_id' => $data[4],
                    'status' => 1,
                ]);

            }
            fclose($handle);

            return 'Data imported Successfully';
        }

    }


    public function CheckStaffOnLeaveOrNot(Request $request){
         // dump($request->all());
              $selected_date  =  $request->selected_date;  
              $datess = str_replace("/", "-", $request->selected_date);
              $selected_date = date('Y-m-d H:m:s', strtotime($datess)); 
              $flag = 0; 
            $StaffAllLeaves = StaffLeave::where('staff_id',$request->staff_id)->get();
          // dd(count($StaffAllLeaves));
            if(count($StaffAllLeaves) != 0){
             
              foreach($StaffAllLeaves as $StaffAllLeave){
                $currentDate = date('Y-m-d', strtotime($selected_date)); 
                $startDate = date('Y-m-d', strtotime($StaffAllLeave->start_leave_date));
                $endDate = date('Y-m-d', strtotime($StaffAllLeave->end_leave_date));   
                    if (($currentDate >= $startDate) && ($currentDate <= $endDate)){   
                      $flag++;
                    }else{    
                       //echo "Current date is not between two dates";  
                    }
              }  

            }
            else{
              //  dd('no'); 
            }

        if ($flag) {
       
        return response()->json([
        'success' => 'true',
        ]);
        } else {
        return response()->json([
        'success' => 'false',

        ]);
        }

    }

}
