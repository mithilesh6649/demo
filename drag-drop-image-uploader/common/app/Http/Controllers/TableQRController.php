<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Branch;
use App\Models\BranchPermission;
use App\Models\Role;
use App\Models\User;
use App\Models\BranchManager;
use App\Models\BranchMenuItem;
use App\Models\BranchMenuCategory;
use App\Models\BranchesPermission;
use App\Models\BranchWorkingHour;
use App\Models\BranchLocality;
use App\Models\City;
use App\Models\BranchRole;
use App\Models\BranchCar;
use App\Models\Cars;
use App\Models\BranchDriver;
use App\Models\Driver;
use App\Models\BranchAssignedPermission;
use App\Models\BranchTableQR;
use Illuminate\Support\Facades\Crypt;
use Session;

class TableQRController extends Controller
{

    public function BranchMenu($id=null)
    {
        return $id;
    }

    public function justupdatedqr(Request $request)
    {

        // $deinin_url=env('BASE_BRANCH_URL').$request->table_number.'/'.Session::get("branch_id");

        // $filename='';
        // $qr_code = base64_encode(\QrCode::format('png')->size(300)->generate($deinin_url));

        // $array = explode('data:image', $qr_code);
        // $folderPath = public_path()."/branch_images/QR/";

        // foreach ($array as $arr) {
        //     if($arr!='' && $arr!=null){

        //         $explodes = explode('base64,', $arr);
        //         $base_64 = $array[0];
        //         $image_type = 'png';
        //         $image_base64 = base64_decode($base_64);
        //         $file = $folderPath . uniqid() . '.'.$image_type;
        //         file_put_contents($file, $image_base64);
        //         $filename = explode($folderPath, $file)[1];
        //     }
        // }

        $BranchTableQR =BranchTableQR::where('id',$request->qrid)->first();
        $BranchTableQR->branch_id = Session::get("branch_id");
        $BranchTableQR->table_number=$request->table_number;
        //$BranchTableQR->qrcode = $filename;
        $BranchTableQR->update();

        return redirect()
            ->route("branch.tableqr")
            ->with(["success" => "Branch table details updated successfully !"]);

    }

    public function deleteBranchtableqr(Request $request)
    {
       $BranchTableQR =BranchTableQR::where('id',$request->id)->first();
       if($BranchTableQR)
       {
          $BranchTableQR->delete();
          $res["success"] = 1;
            return json_encode($res);

       }else{
          $res["success"] = 0;
            return json_encode($res);
       }
    }

    public function Qrtablelist($id=null)
    {
            $tableqrdata=BranchTableQR::where('branch_id',$id)->first();
            $branch_permission = BranchPermission::where('branch_id', $id)->first();

            $managers = User::with('BranchRole')->where(['role_id' => Role::where('role_type', 'manager')
                    ->value('id'), 'status' => '1', 'is_user_locked' => '0'])
                ->get(['id', 'first_name', 'last_name', 'email', 'branch_role_id']);
            $branch = Branch::with('BranchImages:branch_id,image_name', 'branchManagers:branch_id,user_id')->find($id);

            $in_session_managers = BranchManager::where('branch_id', $id)->where('out_sesssion', null)
                ->get();

            $user_images = $branch
                ->BranchImages
                ->toArray();

            $branchManagers = $branch
                ->branchManagers
                ->toArray();

            $branchMenuItems = BranchMenuItem::with('menuItems', 'menuItems.menuCategory')->where('branch_id', $id)->orderBy('created_at', 'DESC')
                ->get();

            $branchMenuCategory = BranchMenuCategory::with('menuCategory')->where('branch_id', $id)->orderBy('created_at', 'DESC')
                ->get();

            $menu_item_availability = DB::table('md_dropdowns')->where('slug', 'menu_item_availability')
                ->get()
                ->toArray();

            $BranchWorkingHour = BranchWorkingHour::where('branch_id', $id)->get();
            $BranchWorkingHourArray = BranchWorkingHour::where('branch_id', $id)->get()
                ->toArray();

            $assign_locality = BranchLocality::where("branch_id", $id)->pluck('city_id')
                ->toArray();
            $city_list = City::whereNotIn('id', $assign_locality)->get();

            $branchLocalities = BranchLocality::with('city')->where("branch_id", $id)->get();

            $branchLocalitiesCities = BranchLocality::where("branch_id", $id)->pluck('city_id')
                ->toArray();

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')
                ->get();

            $branch_roles = BranchRole::where('status', '1')->get();

            //start cars...........
            $assign_cars = BranchCar::pluck('car_id')->toArray();
            $cars = Cars::whereNotIn('id', $assign_cars)->where('status', '1')->get();
            $branchCars = BranchCar::with('car', 'car.owner', 'car.driver')->where("branch_id", $id)->get();

            //end cars..........

            //Drivers
            $assign_drivers = BranchDriver::pluck('driver_id')->toArray();
            $drivers = Driver::whereNotIn('id', $assign_drivers)->where('status', '1')->get();
            $branchDrivers = BranchDriver::with('driver')->where("branch_id", $id)
                ->get();
            //End Drivers

            //Start Branches Permisssions
            $all_branches_permissions = BranchesPermission::get();

            $manager_permissions = BranchAssignedPermission::where('branch_id', $id)->where('branch_role_id', 1)
                ->pluck('branches_permission_id')->toArray();

            $desk1_permissions = BranchAssignedPermission::where('branch_id', $id)->where('branch_role_id', 2)
                ->pluck('branches_permission_id')->toArray();
            $desk2_permissions = BranchAssignedPermission::where('branch_id', $id)->where('branch_role_id', 3)
                ->pluck('branches_permission_id')->toArray();

            return view('branches.edit', compact('branch', 'managers', 'user_images', 'in_session_managers', 'branchMenuItems', 'branchMenuCategory', 'branch_permission', 'menu_item_availability', 'BranchWorkingHour', 'BranchWorkingHourArray', 'city_list', 'branchLocalities', 'branchLocalitiesCities', 'status', 'branch_roles', 'assign_cars', 'cars', 'branchCars', 'assign_drivers', 'drivers', 'branchDrivers', 'all_branches_permissions', 'manager_permissions', 'desk1_permissions', 'desk2_permissions','tableqrdata'));
    }

    public function Qrtablesave(Request $request)
    {
       
        //https://mission-admin.rvtechnologies.in/branch/dinein/menu/branch_id
        
        $deinin_url=env('BASE_BRANCH_URL').'/'.$request->branch_id;

        //$deinin_url=env('BASE_BRANCH_URL').$request->table_number.'/'.$request->branch_id;

        $filename='';
        $qr_code = base64_encode(\QrCode::format('png')->size(300)->generate($deinin_url));

        $array = explode('data:image', $qr_code);
        $folderPath = public_path()."/branch_images/QR/";

        foreach ($array as $arr) {
            if($arr!='' && $arr!=null){

                $explodes = explode('base64,', $arr);
                $base_64 = $array[0];
                $image_type = 'png';
                $image_base64 = base64_decode($base_64);
                $file = $folderPath . uniqid() . '.'.$image_type;
                file_put_contents($file, $image_base64);
                $filename = explode($folderPath, $file)[1];
            }
        }

        $BranchTableQR =new BranchTableQR();
        $BranchTableQR->branch_id = $request->branch_id;
        $BranchTableQR->table_number=$request->table_number;
        $BranchTableQR->qrcode = $filename;
        $BranchTableQR->save();

        return redirect()
            ->route("qrtable.editlist",$request->branch_id)
            ->with(["success" => "Branch table details added successfully !"]);


    }

    public function updatedqr(Request $request)
    {
       
        // $deinin_url=env('BASE_BRANCH_URL').$request->table_number.'/'.$request->branch_id;

        // $filename='';
        // $qr_code = base64_encode(\QrCode::format('png')->size(300)->generate($deinin_url));

        // $array = explode('data:image', $qr_code);
        // $folderPath = public_path()."/branch_images/QR/";

        // foreach ($array as $arr) {
        //     if($arr!='' && $arr!=null){

        //         $explodes = explode('base64,', $arr);
        //         $base_64 = $array[0];
        //         $image_type = 'png';
        //         $image_base64 = base64_decode($base_64);
        //         $file = $folderPath . uniqid() . '.'.$image_type;
        //         file_put_contents($file, $image_base64);
        //         $filename = explode($folderPath, $file)[1];
        //     }
        // }

        $BranchTableQR =BranchTableQR::where('id',$request->qrid)->first();
        $BranchTableQR->branch_id = $request->branch_id;
        $BranchTableQR->table_number=$request->table_number;
        //$BranchTableQR->qrcode = $filename;
        $BranchTableQR->update();

        return redirect()
            ->route("qrtable.editlist",$request->branch_id)
            ->with(["success" => "Branch table details updated successfully !"]);

    }
}
