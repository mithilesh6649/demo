<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchAssignedPermission;
use App\Models\BranchCar;
use App\Models\BranchDriver;
use App\Models\BranchesPermission;
use App\Models\BranchImage;
use App\Models\BranchLocality;
use App\Models\BranchManager;
use App\Models\BranchMenuCategory;
use App\Models\BranchMenuItem;
use App\Models\BranchPermission;
use App\Models\BranchRole;
use App\Models\branchStaffs;
use App\Models\BranchWorkingHour;
use App\Models\Cars;
use App\Models\City;
use App\Models\Designation;
use App\Models\Driver;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;
use App\Models\BranchTableQR;
use Illuminate\Support\Facades\Crypt;

class BranchController extends Controller
{
    public function branchPermissions()
    {
        return view('branches.permissions')->with(['roles' => \App\Models\Role::all(), 'usersPermissions' => [], 'adminsPermissions' => []]);
    }

    //Show all branch list...........
    public function branches()
    {
        if (Auth::user()->can('branch_management')) {
            if(Session::has('branch_id'))
            {
               Session::forget('branch_id');
            }

            $branches = Branch::orderBY('id', 'desc')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')
                ->get();
            $Alldesignation = Designation::where('status', '1')->get();
            $all_branches_permissions = BranchesPermission::get();

            return view('branches.index', compact('branches', 'status', 'Alldesignation', 'all_branches_permissions'));

        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    //Add New Branch...............
    public function addBranch()
    {
        if (Auth::user()
            ->can('add_branch')) {

            $tableqrdata=BranchTableQR::where('branch_id',Session::get("branch_id"))->orderBy('id','DESC')->first();

           if(Session::has('branch_id'))
           {
               if(!$tableqrdata)
                {
                    $deinin_url=env('BASE_BRANCH_URL').'/'.Session::get("branch_id");
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
                    $BranchTableQR = new BranchTableQR();
                    $BranchTableQR->branch_id =Session::get("branch_id");
                    $BranchTableQR->qrcode = $filename;
                    $BranchTableQR->save();

                   $tableqrdata=BranchTableQR::where('branch_id',Session::get("branch_id"))->orderBy('id','DESC')->first();

                }
            }

            

            $managers = User::with('BranchRole')->where(['role_id' => Role::where('role_type', 'manager')
                    ->value('id'), 'status' => '1', 'is_user_locked' => '0'])
                ->get(['id', 'first_name', 'last_name', 'email', 'branch_role_id']);

            $assign_city = BranchLocality::pluck('city_id')->toArray();

            $citys = City::whereNotIn('id', $assign_city)->where('status', '1')
                ->get();

            $city_list = City::where('status', '1')->get();

            $branchLocalities = BranchLocality::with('city')->where("branch_id", Session::get("branch_id"))
                ->get();

            $branchLocalitiesCities = BranchLocality::where("branch_id", Session::get("branch_id"))->pluck('city_id')
                ->toArray();

            $branch_roles = BranchRole::where('status', '1')->get();

            //Cars
            $assign_cars = BranchCar::pluck('car_id')->toArray();
            $cars = Cars::whereNotIn('id', $assign_cars)->where('status', '1')->get();
            $branchCars = BranchCar::with('car', 'car.owner', 'car.driver')->where("branch_id", Session::get("branch_id"))
                ->get();
            //End Cars

            //Drivers
            $assign_drivers = BranchDriver::pluck('driver_id')->toArray();
            $drivers = Driver::whereNotIn('id', $assign_drivers)->where('status', '1')->get();
            $branchDrivers = BranchDriver::with('driver')->where("branch_id", Session::get("branch_id"))
                ->get();
            //End Drivers

            //Start Branches Permisssions
            $all_branches_permissions = BranchesPermission::get();

            return view('branches.add', compact('managers', 'city_list', 'branchLocalities', 'branchLocalitiesCities', 'branch_roles', 'citys', 'cars', 'branchCars', 'assign_cars', 'assign_drivers', 'drivers', 'branchDrivers', 'all_branches_permissions','tableqrdata'));
        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    public function branchPermission()
    {
        if (Auth::user()
            ->can('add_branch')) {

              $tableqrdata=BranchTableQR::where('branch_id',Session::get("branch_id"))->orderBy('id','DESC')->first();

           if(Session::has('branch_id'))
           {
               if(!$tableqrdata)
                {
                    $deinin_url=env('BASE_BRANCH_URL').'/'.Session::get("branch_id");
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
                    $BranchTableQR = new BranchTableQR();
                    $BranchTableQR->branch_id =Session::get("branch_id");
                    $BranchTableQR->qrcode = $filename;
                    $BranchTableQR->save();

                   $tableqrdata=BranchTableQR::where('branch_id',Session::get("branch_id"))->orderBy('id','DESC')->first();

                }
            }

            $managers = User::with('BranchRole')->where(['role_id' => Role::where('role_type', 'manager')
                    ->value('id'), 'status' => '1', 'is_user_locked' => '0'])
                ->get(['id', 'first_name', 'last_name', 'email']);

            $branchLocalities = BranchLocality::with('city')->where("branch_id", Session::get("branch_id"))
                ->get();

            $assign_city = BranchLocality::pluck('city_id')->toArray();

            $citys = City::whereNotIn('id', $assign_city)->where('status', '1')
                ->get();

            $city_list = City::where('status', '1')->get();

            $branchLocalitiesCities = BranchLocality::where("branch_id", Session::get("branch_id"))->pluck('city_id')
                ->toArray();
            //get all branch roles
            // $branchCars = BranchCar::with('car', 'car.owner', 'car.driver')->where("branch_id", Session::get("branch_id"))
            //      ->get();
            // $cars = Cars::where('status', '1')->get();

            $branch_roles = BranchRole::where('status', '1')->get();

            //Cars
            $assign_cars = BranchCar::pluck('car_id')->toArray();
            $cars = Cars::whereNotIn('id', $assign_cars)->where('status', '1')->get();
            $branchCars = BranchCar::with('car', 'car.owner', 'car.driver')->where("branch_id", Session::get("branch_id"))
                ->get();
            //End Cars

            //Drivers
            $assign_drivers = BranchDriver::pluck('driver_id')->toArray();
            $drivers = Driver::whereNotIn('id', $assign_drivers)->where('status', '1')->get();
            $branchDrivers = BranchDriver::with('driver')->where("branch_id", Session::get("branch_id"))
                ->get();
            //End Drivers

            //Start Branches Permisssions
            $all_branches_permissions = BranchesPermission::get();

            //End Branches Permisssions
            return view('branches.add', compact('managers', 'city_list', 'branchLocalities', 'branchLocalitiesCities', 'branch_roles', 'citys', 'branchCars', 'cars', 'assign_cars', 'assign_drivers', 'drivers', 'branchDrivers', 'all_branches_permissions','tableqrdata'));

        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    public function saveBranch(Request $request)
    {

        $BigfileName = null;
        $SmallfileName = null;

        // Big Image Save //

        if ($request->has('branch_image')) {
            $base64 = $request->get('branch_image');
            if ($base64 != "") {

                $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "branch_images/";
                $folderPath = $path;

                $explodes = explode('base64,', $base64);
                $base_64 = $explodes[1];
                $extension = explode('/', $explodes[0])[1];
                $image_type = explode(';', $extension)[0];
                $image_base64 = base64_decode($base_64);
                $file = $folderPath . uniqid() . '.' . $image_type;
                // dd($file);

                file_put_contents($file, $image_base64);

                $BigfileName = explode($folderPath, $file)[1];

                $dataToUpdate['thumbnail'] = $BigfileName;
            } else {
                $BigfileName = '';
            }
        }

        // ------------------- //

        // Small Image Save //

        if ($request->has('branch_small_image')) {
            $base64 = $request->get('branch_small_image');
            if ($base64 != "") {

                $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "branch_small_images/";
                $folderPath = $path;

                $explodes = explode('base64,', $base64);
                $base_64 = $explodes[1];
                $extension = explode('/', $explodes[0])[1];
                $image_type = explode(';', $extension)[0];
                $image_base64 = base64_decode($base_64);
                $file = $folderPath . uniqid() . '.' . $image_type;
                // dd($file);

                file_put_contents($file, $image_base64);

                $SmallfileName = explode($folderPath, $file)[1];

                $dataToUpdate['branch_small_image'] = $SmallfileName;
            } else {
                $SmallfileName = '';
            }
        }

        // --------------- //

        $menuItems = MenuItem::pluck('id')->toArray();
        $menuCategory = MenuCategory::pluck('id')->toArray();
        $response = DB::transaction(function () use ($request, $menuItems, $menuCategory) {
            //dd($request->all());
            $branch_pdf = null;

            if ($request->file("branch_pdf")) {
                $branchPdf = $request->file("branch_pdf");
                $branch_pdf = time() . "." . $branchPdf->getClientOriginalExtension();
                $branchPdf->move("branch_images/pdf", $branch_pdf);
            }

            $branch = new Branch();
            $branch->city_id = $request->city_id;
            $branch->title_en = $request->title_en;
            $branch->title_ar = $request->title_ar;
            $branch->description_en = $request->description_en;
            $branch->description_ar = $request->description_ar;
            $branch->email = $request->email;
            $branch->whatsapp_number = $request->whatsapp_number;
            $branch->phone_number = $request->phone_number;
            $branch->secondary_phone_number = $request->secondary_phone_number;
            $branch->country = $request->country_code;
            $branch->address = $request->address;
            $branch->map_link = $request->map_link;
            $branch->tour_link = $request->tour_link;
            $branch->branch_pdf = $branch_pdf;
            // $branch->manager_id = json_encode($request->managers_id);
            $branch->save();

            // Save Banch Big Image //

            if ($request->file('branch_image')) {
                $BigfileName = "branch_" . time() . "." . $request->file("branch_image")->getClientOriginalExtension();
                $request->file('branch_image')->move('branch_images', $BigfileName);

                $branchImage = BranchImage::create(['branch_id' => $branch->id, 'image_name' => $BigfileName, 'image_type' => 'big',
                ]);

            }

            // ----------- //

            // Save Banch Small Image //

            if ($request->file('branch_small_image')) {
                $SmallfileName = "branch_small_" . time() . "." . $request->file("branch_small_image")->getClientOriginalExtension();
                $request->file('branch_small_image')->move('branch_small_images', $SmallfileName);

                $branchImage = BranchImage::create(['branch_id' => $branch->id, 'image_name' => $SmallfileName, 'image_type' => 'small',
                ]);

            }

            // ----------- //

            Session::put('branch_id', $branch->id);

            if ($request->managers_id != "") {
                foreach ($request->managers_id as $key => $id) {
                    $branchManager = new BranchManager();
                    $branchManager->branch_id = $branch->id;
                    $branchManager->user_id = $id;
                    $branchManager->in_sesssion = now()
                        ->toDateTimeString();
                    $branchManager->out_sesssion = null;
                    $branchManager->save();
                }
            }

            foreach ($menuItems as $key => $id) {
                $branchmenuItems = new BranchMenuItem();
                $branchmenuItems->branch_id = $branch->id;
                $branchmenuItems->menu_item_id = $id;
                $branchmenuItems->status = 1;
                $branchmenuItems->save();
            }

            //  foreach ($menuCategory as $key => $id) {
            //     $branchmenuCategory = new BranchMenuCategory();
            //     $branchmenuCategory->branch_id = $branch->id;
            //     $branchmenuCategory->menu_category_id = $id;
            //     $branchmenuCategory->status = 1;
            //     $branchmenuCategory->save();
            // }

        });

        return "success";

    }

    //store Image
    public function storeImage(Request $request)
    {

        $proimages = $request->file('file');

        try
        {
            for ($i = 0; $i < count($proimages); $i++) {
                $image_path = $proimages[$i]->getClientOriginalName();
                $proimages[$i]->move(public_path('branch_images'), $image_path);

                $branchImage = BranchImage::create(['branch_id' => Session::get('branch_id'), 'image_name' => $image_path,

                ]);
            }

            //Session::forget('branch_id');

        } catch (Exceptions $e) {
            Branch::where('id', Session::get('branch_id'))->forceDelete();
            return false;
        }

    }

    public function checkBranchEmail(Request $request)
    {
        $email = Branch::where('email', $request->email)
            ->get();
        if (count($email) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }
    }

    public function editBranch($id)
    {
        if (Auth::user()->can('edit_branch')) {
            
            $tableqrdata=BranchTableQR::where('branch_id',$id)->orderBy('id','DESC')->first();

            if(!$tableqrdata)
            {
                $deinin_url=env('BASE_BRANCH_URL').'/'.$id;
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
                $BranchTableQR = new BranchTableQR();
                $BranchTableQR->branch_id =$id;
                $BranchTableQR->qrcode = $filename;
                $BranchTableQR->save();

               $tableqrdata=BranchTableQR::where('branch_id',$id)->orderBy('id','DESC')->first();

            }

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
        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    public function viewBranch($id)
    {
        if (Auth::user()->can('view_branch')) {

           $tableqrdata=BranchTableQR::where('branch_id',$id)->orderBy('id','DESC')->first();

            if(!$tableqrdata)
            {
                $deinin_url=env('BASE_BRANCH_URL').'/'.$id;
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
                $BranchTableQR = new BranchTableQR();
                $BranchTableQR->branch_id =$id;
                $BranchTableQR->qrcode = $filename;
                $BranchTableQR->save();

               $tableqrdata=BranchTableQR::where('branch_id',$id)->orderBy('id','DESC')->first();

            }

            $managers = User::with('BranchRole')->where(['role_id' => Role::where('role_type', 'manager')
                    ->value('id'), 'status' => '1', 'is_user_locked' => '0'])
                ->get(['id', 'first_name', 'last_name', 'email', 'branch_role_id']);

            $branch_permission = BranchPermission::where('branch_id', $id)->first();

            $branch = Branch::with('branchManagers.user', 'BranchImages')->find($id);

            $in_session_managers = BranchManager::where('branch_id', $id)->where('out_sesssion', null)
                ->get();

            $branchMenuItems = BranchMenuItem::with('menuItems', 'menuItems.menuCategory')->where('branch_id', $id)->orderBy('created_at', 'DESC')
                ->get();

            $branchMenuCategory = BranchMenuCategory::with('menuCategory')->where('branch_id', $id)->orderBy('created_at', 'DESC')
                ->get();

            $BranchWorkingHour = BranchWorkingHour::where('branch_id', $id)->get();

            $city_list = City::get();

            $branchLocalities = BranchLocality::with('city')->where("branch_id", $id)->get();

            $branchLocalitiesCities = BranchLocality::where("branch_id", $id)->pluck('city_id')
                ->toArray();

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')
                ->get();

            $branch_roles = BranchRole::where('status', '1')->get();

            //For Branch Staff Coding............
            $AllbranchStaff = branchStaffs::with('Staff')->where('branch_id', $id)->whereNull('end_date')->get();

            $Alldesignation = Designation::where('status', '1')->get();

            $branchCars = BranchCar::with('car', 'car.owner', 'car.driver')->where("branch_id", $id)->get();

            $branchDrivers = BranchDriver::with('driver')->where("branch_id", $id)
                ->get();

            //Start Branches Permisssions
            $all_branches_permissions = BranchesPermission::get();

            $manager_permissions = BranchAssignedPermission::where('branch_id', $id)->where('branch_role_id', 1)
                ->pluck('branches_permission_id')->toArray();

            $desk1_permissions = BranchAssignedPermission::where('branch_id', $id)->where('branch_role_id', 2)
                ->pluck('branches_permission_id')->toArray();
            $desk2_permissions = BranchAssignedPermission::where('branch_id', $id)->where('branch_role_id', 3)
                ->pluck('branches_permission_id')->toArray();

            return view('branches.view', compact('branch', 'branchMenuItems', 'branchMenuCategory', 'branch_permission', 'managers', 'in_session_managers', 'BranchWorkingHour', 'city_list', 'branchLocalities', 'branchLocalitiesCities', 'status', 'branch_roles', 'AllbranchStaff', 'Alldesignation', 'branchCars', 'branchDrivers', 'all_branches_permissions', 'manager_permissions', 'desk1_permissions', 'desk2_permissions','tableqrdata'));

        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    public function updateBranch(Request $request)
    {

        DB::beginTransaction();

        try
        {

            $BigfileName = null;
            $SmallfileName = null;
            // Big Image Save //

            if ($request->has('branch_image')) {
                $base64 = $request->get('branch_image');
                if ($base64 != "") {

                    $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "branch_images/";
                    $folderPath = $path;

                    $explodes = explode('base64,', $base64);
                    $base_64 = $explodes[1];
                    $extension = explode('/', $explodes[0])[1];
                    $image_type = explode(';', $extension)[0];
                    $image_base64 = base64_decode($base_64);
                    $file = $folderPath . uniqid() . '.' . $image_type;
                    // dd($file);

                    file_put_contents($file, $image_base64);

                    $BigfileName = explode($folderPath, $file)[1];

                    $dataToUpdate['thumbnail'] = $BigfileName;
                } else {
                    $BigfileName = '';
                }
            }

            // ------------------- //

            // Small Image Save //

            if ($request->has('branch_small_image')) {
                $base64 = $request->get('branch_small_image');
                if ($base64 != "") {

                    $path = $_SERVER['DOCUMENT_ROOT'] . "/" . env('FRONT_END_PROJECT_NAME') . "branch_small_images/";
                    $folderPath = $path;

                    $explodes = explode('base64,', $base64);
                    $base_64 = $explodes[1];
                    $extension = explode('/', $explodes[0])[1];
                    $image_type = explode(';', $extension)[0];
                    $image_base64 = base64_decode($base_64);
                    $file = $folderPath . uniqid() . '.' . $image_type;
                    // dd($file);

                    file_put_contents($file, $image_base64);

                    $SmallfileName = explode($folderPath, $file)[1];

                    $dataToUpdate['branch_small_image'] = $SmallfileName;
                } else {
                    $SmallfileName = '';
                }
            }

            // --------------- //

            $branch = Branch::where('id', $request->branch_id)
                ->first();
            $branch->city_id = $request->city_id;
            $branch->title_en = $request->title_en;
            $branch->title_ar = $request->title_ar;

            $branch->description_en = $request->description_en;
            $branch->description_ar = $request->description_ar;
            $branch->email = $request->email;
            $branch->phone_number = $request->phone_number;
            $branch->whatsapp_number = $request->whatsapp_number;
            $branch->country = $request->country_code;
            $branch->address = $request->address;
            $branch->status = $request->status;
            $branch->secondary_phone_number = $request->secondary_phone_number;
            $branch->map_link = $request->map_link;
            $branch->tour_link = $request->tour_link;

            if ($request->file("branch_pdf")) {
                $branchPdf = $request->file("branch_pdf");
                $branch_pdf = time() . "." . $branchPdf->getClientOriginalExtension();
                $branchPdf->move("branch_images/pdf", $branch_pdf);
                $branch->branch_pdf = $branch_pdf;

            }

            $branch->save();

            // Save Banch Big Image //

            if ($request->old_big_image_name == null) {
                if ($request->file('branch_image')) {
                    $BigfileName = "branch_" . time() . "." . $request->file("branch_image")->getClientOriginalExtension();
                    $request->file('branch_image')->move('branch_images', $BigfileName);

                    $branch_image_big = new BranchImage;

                    $branch_image_big->branch_id = $branch->id;
                    $branch_image_big->image_name = $BigfileName;
                    $branch_image_big->image_type = 'big';

                    $branch_image_big->save();

                }
            }

            // ----------- //

            // Save Banch Small Image //
            if ($request->old_small_image_name == null) {
                if ($request->file('branch_small_image')) {
                    $SmallfileName = "branch_small_" . time() . "." . $request->file("branch_small_image")->getClientOriginalExtension();
                    $request->file('branch_small_image')->move('branch_small_images', $SmallfileName);

                    $branch_image_small = new BranchImage;

                    $branch_image_small->branch_id = $branch->id;
                    $branch_image_small->image_name = $SmallfileName;
                    $branch_image_small->image_type = 'small';

                    $branch_image_small->save();

                }
            }

            // ----------- //

            Session::put('branch_id', $branch->id);

            //Update Brach Managers  Details
            $branchManagers = BranchManager::where('branch_id', $request->branch_id)
                ->where('out_sesssion', null)
                ->get(['user_id'])
                ->toArray();

            //Check manager data in requesr
            if ($request->managers_id != '') {

                if (count($branchManagers) > 0) {
                    $managers_id = [];
                    if ($request->managers_id != '') {
                        $managers_id = $request->managers_id;
                    }

                    //$managers_id = $request->managers_id;
                    foreach ($branchManagers as $key) {

                        if (in_array($key['user_id'], $managers_id)) {
                            // dump('yes',$key['user_id']);
                            // $branchManagers = BranchManager::where('branch_id',$request->branch_id)->where('user_id',$key['user_id'])->first();
                            // $branchManagers->out_sesssion = null;
                            // $branchManagers->status = "1";
                            // $branchManagers->save();

                        } else {
                            // dump('no',$key['user_id']);
                            $branchManagers = BranchManager::where('branch_id', $request->branch_id)
                                ->where('user_id', $key['user_id'])->where('out_sesssion', null)
                                ->first();
                            $branchManagers->out_sesssion = now()
                                ->toDateTimeString();
                            $branchManagers->status = "0";
                            $branchManagers->save();

                        }
                    }

                    if ($request->managers_id != '') {
                        //Manage additional manager added in branch
                        foreach ($request->managers_id as $key => $id) {

                            $response = BranchManager::where('branch_id', $request->branch_id)
                                ->where('out_sesssion', null)
                                ->where('user_id', $id)->first();

                            if ($response) {

                            } else {
                                $branchManager = new BranchManager();
                                $branchManager->branch_id = $request->branch_id;
                                $branchManager->user_id = $id;
                                $branchManager->in_sesssion = now()
                                    ->toDateTimeString();
                                $branchManager->out_sesssion = null;
                                $branchManager->save();

                            }

                        }
                    }

                } else {

                    //Manage additional manager added in branch
                    foreach ($request->managers_id as $key => $id) {

                        $response = BranchManager::where('branch_id', $request->branch_id)
                            ->where('out_sesssion', null)
                            ->where('user_id', $id)->first();

                        if ($response) {

                        } else {
                            $branchManager = new BranchManager();
                            $branchManager->branch_id = $request->branch_id;
                            $branchManager->user_id = $id;
                            $branchManager->in_sesssion = now()
                                ->toDateTimeString();
                            $branchManager->out_sesssion = null;
                            $branchManager->save();

                        }

                    }
                }

            }
            //Manage Branch Images
            // $userImage = BranchImage::where('branch_id', $request->branch_id)
            //     ->forceDelete();

            // $old_images_old = explode("--", $request->old_images_name);
            // for ($i = 0; $i < count(explode("--", $request->old_images_name)) - 1; $i++) {
            //     $userImage = BranchImage::create(['branch_id' => $request->branch_id, 'image_name' => $old_images_old[$i],

            //     ]);

            // }

            Session::put('current_user_id', $request->user_id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route("branch.list")
                ->with("error", "something went wrong");
        }

        return "success";

    }

    public function updateImage(Request $request)
    {

        $proimages = $request->file('file');

        for ($i = 0; $i < count($proimages); $i++) {
            $image_path = $proimages[$i]->getClientOriginalName();
            $proimages[$i]->move(public_path('branch_images'), $image_path);

            $branchImage = BranchImage::create(['branch_id' => Session::get('branch_id'), 'image_name' => $image_path,

            ]);

        }

    }

    public function branchInfoUpdate(Request $request)
    {

        $branch_info = Branch::where('id', $request->branch_id)
            ->first();
        $branch_info->cuisins = $request->cuisins;
        $branch_info->rating = $request->rating;
        //  $branch_info->branch_delivery_time = $request->branch_delivery_time;
        // $branch_info->branch_pickup_time = $request->branch_pickup_time;
        $branch_info->accepts_pre_order = $request->accepts_pre_order;
        $branch_info->minimum_order_amount = $request->minimum_order_amount;
        $branch_info->update();

        $BranchWorkingHour = BranchWorkingHour::where('branch_id', $request->branch_id)
            ->forceDelete();

        BranchWorkingHour::where('branch_id', $request->branch_id)->onlyTrashed()->forceDelete();

        $start_hour = array();
        $starting_hour = array_filter($request->starting_hour);

        foreach ($starting_hour as $data) {
            $start_hour[] = date('H:i', strtotime($data));
        }

        $ending_hour = array_filter($request->ending_hour);
        $end_hour = array();

        foreach ($ending_hour as $data) {
            $end_hour[] = date('H:i', strtotime($data));
        }

        foreach ($request->days as $key => $day_name) {
            $BranchWorkingHour = new BranchWorkingHour();
            $BranchWorkingHour->branch_id = $request->branch_id;
            $BranchWorkingHour->days = $day_name;
            $BranchWorkingHour->starting_hour = $start_hour[$key];
            $BranchWorkingHour->ending_hour = $end_hour[$key];
            $BranchWorkingHour->save();
        }

        return 'success';

    }

    public function BranchAdditionalInfo(Request $request)
    {
        //  dd($request->all());
        //       $starting_hour =  date('H:i',strtotime($request->starting_hour[0]));
        // dd($starting_hour);
        $start_hour = array();
        $starting_hour = array_filter($request->starting_hour);
        // dd($starting_hour);
        foreach ($starting_hour as $data) {
            $start_hour[] = date('H:i', strtotime($data));
        }

        // dd($start_hour);
        $ending_hour = array_filter($request->ending_hour);
        $end_hour = array();

        foreach ($ending_hour as $data) {
            $end_hour[] = date('H:i', strtotime($data));
        }

        $response = DB::transaction(function () use ($request, $start_hour, $end_hour) {
            //     dd($request->all());
            $branch_info = Branch::where('id', Session::get('branch_id'))->first();
            $branch_info->cuisins = $request->cuisins;
            // $branch_info->branch_delivery_time = $request->branch_delivery_time;
            //$branch_info->branch_pickup_time = $request->branch_pickup_time;
            $branch_info->rating = $request->rating;
            $branch_info->accepts_pre_order = $request->accepts_pre_order;
            $branch_info->minimum_order_amount = $request->minimum_order_amount;
            $branch_info->update();

            //Manage additional info days
            foreach ($request->days as $key => $day_name) {
                $BranchWorkingHour = new BranchWorkingHour();
                $BranchWorkingHour->branch_id = Session::get('branch_id');
                $BranchWorkingHour->days = $day_name;
                $BranchWorkingHour->starting_hour = $start_hour[$key];
                $BranchWorkingHour->ending_hour = $end_hour[$key];
                $BranchWorkingHour->save();
            }

        });

        return "success";
        //return redirect()->route('branch.permission')->with(['success'=>'Branch info   has been added successfully!']);

    }

    // StartBranchLocalities
    public function SaveBranchLocalities(Request $request)
    {

        $branchLocality = new BranchLocality();
        $branchLocality->branch_id = Session::get("branch_id");
        $branchLocality->city_id = $request->localities_id;
        $branchLocality->delivery_fee = $request->delivery_fee;
        $branchLocality->minimum_order_amount = $request->minimum_order_amount;
        $branchLocality->delivery_time = $request->delivery_time;
        $branchLocality->save();
        return redirect()
            ->route("branch.localities")
            ->with(["success" => "Branch localities addedd successfully !"]);
    }

    public function SaveEditBranchLocalities(Request $request)
    {

        $branchLocality = new BranchLocality();
        $branchLocality->branch_id = $request->branch_id;
        $branchLocality->city_id = $request->localities_id;
        $branchLocality->delivery_fee = $request->delivery_fee;
        $branchLocality->minimum_order_amount = $request->minimum_order_amount;
        $branchLocality->delivery_time = $request->delivery_time;
        $branchLocality->save();

        return redirect()
            ->back()
            ->with(["success" => "Branch localities addedd successfully !"]);

    }

    public function deleteBranchLocalities(Request $request)
    {
        // dd($request->all());
        $deleteBranchLocalities = BranchLocality::where("id", $request->id)
            ->forceDelete();
        if ($deleteBranchLocalities) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function BranchLocalitiesEditJustCreated(Request $request)
    {

        $assign_city = BranchLocality::whereNotIn("city_id", [$request
                ->city_id])
                ->pluck('city_id')
            ->toArray();

        $city_list = City::whereNotIn('id', $assign_city)->get();

        $branchLocalities = BranchLocality::with('city')->where("id", $request->id)
            ->first();

        $branchLocalitiesCities = BranchLocality::where("branch_id", $request->branch_id)
            ->pluck('city_id')
            ->toArray();

        $result_view = view('branches.edit_localities_partial', compact('city_list', 'branchLocalities', 'branchLocalitiesCities'))->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

    public function BranchLocalitiesUpdateJustCreated(Request $request)
    {

        $BranchLocality = BranchLocality::where('id', $request->current_localities_id)
            ->first();

        if (isset($request->localities_id)) {
            $BranchLocality->city_id = $request->localities_id;
        }

        $BranchLocality->delivery_fee = $request->delivery_fee;
        $BranchLocality->minimum_order_amount = $request->minimum_order_amount;
        $BranchLocality->delivery_time = $request->edelivery_time;
        $BranchLocality->update();
        return redirect()
            ->route("branch.localities")
            ->with(["success" => "Branch localities Updated successfully !"]);

    }

    public function BranchLocalitiesUpdateExisting(Request $request)
    {

        $BranchLocality = BranchLocality::where('id', $request->current_localities_id)
            ->first();

        if (isset($request->localities_id)) {
            $BranchLocality->city_id = $request->localities_id;
        }

        $BranchLocality->delivery_fee = $request->delivery_fee;
        $BranchLocality->minimum_order_amount = $request->minimum_order_amount;
        $BranchLocality->delivery_time = $request->edelivery_time;
        $BranchLocality->update();
        return redirect()
            ->back()
            ->with(["success" => "Branch localities Updated successfully !"]);
    }

    //EndBranchLocalities

    //StartBranchCars
    public function SaveBranchCars(Request $request)
    {
        //  dd($request->all());
        $branchCar = new BranchCar();
        $branchCar->branch_id = Session::get("branch_id");
        $branchCar->car_id = $request->cars_id;
        $branchCar->save();
        return redirect()
            ->route("branch.cars")
            ->with(["success" => "Branch Cars addedd successfully !"]);

    }

    public function deleteBranchCars(Request $request)
    {
        // dd($request->all());
        $deleteBranchCars = BranchCar::where("id", $request->id)
            ->forceDelete();
        if ($deleteBranchCars) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function BranchCarsEditJustCreated(Request $request)
    {

        //  dd($request->all());
        // $assign_city = BranchCar::whereNotIn("car_id",[$request->car_id])->pluck('car_id')->toArray();

        //  $city_list = City::whereNotIn('id',$assign_city)->get();
        //   $branchCars = BranchCar::with('car')->where("id",$request->id)->first();
        //   $branchCarCities = BranchCar::where("branch_id", $request->branch_id)->pluck('car_id')->toArray();

        $assign_cars = BranchCar::whereNotIn("car_id", [$request
                ->car_id])
                ->pluck('car_id')
            ->toArray();
        $cars = Cars::whereNotIn('id', $assign_cars)->where('status', '1')->get();

        //  return  $cars = Cars::where('status', '1')->get();

        $selcar = $request->car_id;
        $branch_car_id = $request->id;
        $result_view = view('branches.edit_cars_partial', compact('cars', 'assign_cars', 'selcar', 'branch_car_id'))->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

    public function BranchCarsUpdateJustCreated(Request $request)
    {

        $BranchCar = BranchCar::where('id', $request->current_id)
            ->first();

        $BranchCar->car_id = $request->cars_id;
        $BranchCar->update();
        return redirect()
            ->route("branch.cars")
            ->with(["success" => "Branch Cars Updated successfully !"]);

    }

    public function SaveEditBranchCars(Request $request)
    {

        $branchCar = new BranchCar();
        $branchCar->branch_id = $request->branch_id;
        $branchCar->car_id = $request->cars_id;
        $branchCar->save();

        return redirect()
            ->back()
            ->with(["success" => "Branch Cars added successfully !"]);

    }

    public function BranchCarsUpdateExisting(Request $request)
    {
        $BranchCar = BranchCar::where('id', $request->current_id)
            ->first();
        $BranchCar->car_id = $request->cars_id;
        $BranchCar->update();
        return redirect()
            ->back()
            ->with(["success" => "Branch car Updated successfully !"]);
    }

    //EndBranchCars
    public function deleteBranch(Request $request)
    {

        // $branch = Branch::where('id', $request->id)->each(function ($branch) {

        //     // BranchAssignedPermission [delete all related to current baranch]
        //     BranchAssignedPermission::where('branch_id', $branch->id)->each(function ($BranchAssignedPermission) {
        //         $BranchAssignedPermission->delete();
        //     });

        //        // BranchCar [delete all related to current baranch]
        //     BranchCar::where('branch_id', $branch->id)->each(function ($BranchCar) {
        //         $BranchCar->delete();
        //     });

        //        // BranchDriver [delete all related to current baranch]
        //     BranchDriver::where('branch_id', $branch->id)->each(function ($BranchDriver) {
        //         $BranchDriver->delete();
        //     });

        //        // BranchImage [delete all related to current baranch]
        //     BranchImage::where('branch_id', $branch->id)->each(function ($BranchImage) {
        //         $BranchImage->delete();
        //     });

        //     // BranchLocality [delete all related to current baranch]
        //     BranchLocality::where('branch_id', $branch->id)->each(function ($BranchLocality) {
        //         $BranchLocality->delete();
        //     });

        //     // BranchLog [delete all related to current baranch]
        //     BranchLog::where('branch_id', $branch->id)->each(function ($BranchLog) {
        //         $BranchLog->delete();
        //     });

        //     // BranchManager [delete all related to current baranch]
        //     BranchManager::where('branch_id', $branch->id)->each(function ($BranchManager) {
        //         $BranchManager->delete();
        //     });

        //     // branchStaffs [delete all related to current baranch]
        //     branchStaffs::where('branch_id', $branch->id)->each(function ($branchStaffs) {
        //         $branchStaffs->delete();
        //     });

        //      // BranchWorkingHour [delete all related to current baranch]
        //     BranchWorkingHour::where('branch_id', $branch->id)->each(function ($BranchWorkingHour) {
        //         $BranchWorkingHour->delete();
        //     });

        //      // BranchMenuCategory [delete all related to current baranch]
        //     BranchMenuCategory::where('branch_id', $branch->id)->each(function ($BranchMenuCategory) {
        //         $BranchMenuCategory->delete();
        //     });

        //      // BranchTip [delete all related to current baranch]
        //     BranchTip::where('branch_id', $branch->id)->each(function ($BranchTip) {
        //         $BranchTip->delete();
        //     });

        //      // BranchTipBalances [delete all related to current baranch]
        //     BranchTipBalances::where('branch_id', $branch->id)->each(function ($BranchTipBalances) {
        //         $BranchTipBalances->delete();
        //     });

        //      // BranchTipDistributions [delete all related to current baranch]
        //     BranchTipDistributions::where('branch_id', $branch->id)->each(function ($BranchTipDistributions) {
        //         $BranchTipDistributions->delete();
        //     });

        //      // DiscountBranch [delete all related to current baranch]
        //     DiscountBranch::where('branch_id', $branch->id)->each(function ($DiscountBranch) {
        //         $DiscountBranch->delete();
        //     });

        //      // CouponCodeBranch [delete all related to current baranch]
        //     CouponCodeBranch::where('branch_id', $branch->id)->each(function ($CouponCodeBranch) {
        //         $CouponCodeBranch->delete();
        //     });

        //       // CurrentOfferBranch [delete all related to current baranch]
        //     CurrentOfferBranch::where('branch_id', $branch->id)->each(function ($CurrentOfferBranch) {
        //         $CurrentOfferBranch->delete();
        //     });

        //       // CheckoutOfferBranch [delete all related to current baranch]
        //     CheckoutOfferBranch::where('branch_id', $branch->id)->each(function ($CheckoutOfferBranch) {
        //         $CheckoutOfferBranch->delete();
        //     });

        //     //Final Parent Element
        //     $branch->delete();

        // });

        // // $deleteUser = User::where("id", $request->id)->delete();
        // if ($branch) {
        //     $res["success"] = 1;
        //     return json_encode($res);
        // } else {
        //     $res["success"] = 0;
        //     return json_encode($res);
        // }

        $deleteBranch = Branch::where('id', $request->id)
            ->delete();
        if ($deleteBranch) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    //Save Drivers.........

    public function SaveBranchDrivers(Request $request)
    {
        // dd($request->all());
        $branchDriver = new BranchDriver();
        $branchDriver->branch_id = Session::get("branch_id");
        $branchDriver->driver_id = $request->driver_id;
        $branchDriver->save();
        return redirect()
            ->route("branch.drivers")
            ->with(["success" => "Branch Driver addedd successfully !"]);

    }
    public function SaveBranchqrcode(Request $request)
    {
      
       $deinin_url=env('BASE_BRANCH_URL').'/'.Session::get("branch_id");
      // $deinin_url=env('BASE_BRANCH_URL').$request->table_number.'/'.Session::get("branch_id");

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

        $BranchTableQR = new BranchTableQR();
        $BranchTableQR->branch_id = Session::get("branch_id");
        $BranchTableQR->table_number=$request->table_number;
        $BranchTableQR->qrcode = $filename;
        $BranchTableQR->save();

        return redirect()
            ->route("branch.tableqr")
            ->with(["success" => "Branch table details addedd successfully !"]);
    }

    public function deleteBranchDrivers(Request $request)
    {
        // dd($request->all());
        $deleteBranchDrivers = BranchDriver::where("id", $request->id)
            ->forceDelete();
        if ($deleteBranchDrivers) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function BranchDriversEditJustCreated(Request $request)
    {

        $assign_drivers = BranchDriver::whereNotIn("driver_id", [$request
                ->driver_id])
                ->pluck('driver_id')
            ->toArray();
        $drivers = Driver::whereNotIn('id', $assign_drivers)->where('status', '1')->get();

        $seldri = $request->driver_id;
        $branch_dri_id = $request->id;
        $result_view = view('branches.edit_drivers_partial', compact('drivers', 'assign_drivers', 'seldri', 'branch_dri_id'))->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

    public function BranchDriversUpdateJustCreated(Request $request)
    {
        //return $request->all();
        $BranchDriver = BranchDriver::where('id', $request->current_id)
            ->first();

        $BranchDriver->driver_id = $request->driver_id;
        $BranchDriver->update();
        return redirect()
            ->route("branch.drivers")
            ->with(["success" => "Branch Drivers Updated successfully !"]);

    }

    public function SaveEditBranchDrivers(Request $request)
    {

        $BranchDriver = new BranchDriver();
        $BranchDriver->branch_id = $request->branch_id;
        $BranchDriver->driver_id = $request->driver_id;
        $BranchDriver->save();

        return redirect()
            ->back()
            ->with(["success" => "Branch Driver added successfully !"]);

    }

    public function BranchDriversUpdateExisting(Request $request)
    {
        $BranchDriver = BranchDriver::where('id', $request->current_id)
            ->first();
        $BranchDriver->driver_id = $request->driver_id;
        $BranchDriver->update();
        return redirect()
            ->back()
            ->with(["success" => "Branch Driver Updated successfully !"]);
    }

    //deletedBranchList
    public function deletedBranchesList()
    {

        if (Auth::user()->can("view_deleted_branch")) {

            $branchesList = Branch::orderBY('id', 'desc')->onlyTrashed()
                ->get();
            //dd($usersList);
            return view('branches.deleted_branches_list', compact('branchesList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with("warning", "You do not have permission for this action!");
        }

    }

    //Restore Branch
    public function restoreBranch(Request $request)
    {
        $branchesList = Branch::withTrashed()->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete Branch
    public function permanentDeleteBranch(Request $request)
    {
        $branchesList = Branch::onlyTrashed()->find($request->id)
            ->forceDelete();
        return "success";
    }

    //Change Branch Menu Items Status

    public function changeItemStatus(Request $request)
    {

        $BranchMenuItem = BranchMenuItem::where('id', $request->id)
            ->first();
        $BranchMenuItem->status = $request->status;
        $BranchMenuItem->availabality = $request->minutes;
        $BranchMenuItem->update();

        return response()
            ->json(['success' => true, 'status' => 'true',

            ]);

    }

    //Change Branch Menu Items Category Status

    public function changeCategoryStatus(Request $request)
    {

        $BranchMenuCategory = BranchMenuCategory::where('id', $request->id)
            ->first();
        $BranchMenuCategory->status = $request->status;
        $BranchMenuCategory->update();

        return response()
            ->json(['success' => true, 'status' => 'true',

            ]);

    }

    //Save Permissions
    public function branchPermissionSave(Request $request)
    {
        // BranchAssignedPermission

        if ($request->manager_permission) {

            foreach ($request->manager_permission as $key => $id) {
                $BranchAssignedPermission = new BranchAssignedPermission();
                $BranchAssignedPermission->branches_permission_id = $id;
                $BranchAssignedPermission->branch_id = Session::get('branch_id');
                $BranchAssignedPermission->branch_role_id = $request->manager_role[0];
                $BranchAssignedPermission->status = 1;
                $BranchAssignedPermission->save();
            }
        }

        if ($request->desk1_permission) {

            foreach ($request->desk1_permission as $key => $id) {
                $BranchAssignedPermission = new BranchAssignedPermission();
                $BranchAssignedPermission->branches_permission_id = $id;
                $BranchAssignedPermission->branch_id = Session::get('branch_id');
                $BranchAssignedPermission->branch_role_id = $request->desk1_role[0];
                $BranchAssignedPermission->status = 1;
                $BranchAssignedPermission->save();
            }

        }

        if ($request->desk2_permission) {

            foreach ($request->desk2_permission as $key => $id) {
                $BranchAssignedPermission = new BranchAssignedPermission();
                $BranchAssignedPermission->branches_permission_id = $id;
                $BranchAssignedPermission->branch_id = Session::get('branch_id');
                $BranchAssignedPermission->branch_role_id = $request->desk2_role[0];
                $BranchAssignedPermission->status = 1;
                $BranchAssignedPermission->save();
            }

        }

        return 'success';
        //return redirect()->route('branch.localities')->with(['success'=>' Permissions has been added successfully!']);

    }

    //Update Permissions
    public function branchPermissionUpdate(Request $request)
    {

        DB::beginTransaction();

        try
        {

            $branch_permission_delete = BranchAssignedPermission::where('branch_id', $request->branch_id)
                ->delete();

            if ($request->manager_permission) {

                foreach ($request->manager_permission as $key => $id) {
                    $BranchAssignedPermission = new BranchAssignedPermission();
                    $BranchAssignedPermission->branches_permission_id = $id;
                    $BranchAssignedPermission->branch_id = $request->branch_id;
                    $BranchAssignedPermission->branch_role_id = $request->manager_role[0];
                    $BranchAssignedPermission->status = 1;
                    $BranchAssignedPermission->save();
                }
            }

            if ($request->desk1_permission) {

                foreach ($request->desk1_permission as $key => $id) {
                    $BranchAssignedPermission = new BranchAssignedPermission();
                    $BranchAssignedPermission->branches_permission_id = $id;
                    $BranchAssignedPermission->branch_id = $request->branch_id;
                    $BranchAssignedPermission->branch_role_id = $request->desk1_role[0];
                    $BranchAssignedPermission->status = 1;
                    $BranchAssignedPermission->save();
                }
            }

            if ($request->desk2_permission) {

                foreach ($request->desk2_permission as $key => $id) {
                    $BranchAssignedPermission = new BranchAssignedPermission();
                    $BranchAssignedPermission->branches_permission_id = $id;
                    $BranchAssignedPermission->branch_id = $request->branch_id;
                    $BranchAssignedPermission->branch_role_id = $request->desk2_role[0];
                    $BranchAssignedPermission->status = 1;
                    $BranchAssignedPermission->save();
                }
            }

            DB::commit();

            return "success"; //redirect()->back()->with(['success'=>' Permissions has been updated successfully!']);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with(['success' => ' Something went to wrong ']);
        }

    }

    //remove pdf
    public function branchPdfRemove(Request $request)
    {
        $branchData = Branch::where('id', $request->id)
            ->first();
        $branchData->branch_pdf = null;
        if ($branchData->update()) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    //  Check Branch Staff //
    public function get_staff_info(Request $request)
    {

        $data = Staff::where(['staff_code' => $request->staff_code])->with('designation_name')->first();

        return json_encode(['data' => $data]);

    }

    //  ------------------- //

    // Branch Image Remove //

    public function branch_image_remove(Request $request)
    {
        BranchImage::where(['id' => $request->id])->delete();

        return json_encode(['success' => 1]);
    }

    // ------------------ //
}
