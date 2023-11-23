<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Inventory;
use App\Models\MdBrand;
use App\Models\MdModel;
use App\Models\Coupon;
use App\Models\AutoAndMotoPartsCategory;
use \App\Models\AutoMotorSubCategory;
use App\Models\PowerEquipmentCategory;
use App\Models\PowerEquipmentSubCategory;
use App\Models\Trim;
use App\Models\Style;
use App\Models\ExtendedWarrantyPlan;
use App\Models\Role;
use App\Models\Engine;
use App\Models\RepairService;
use App\Models\RepairServiceCategory;
use App\Models\ExtendedWarrantyCoveredComponent;

class RecycleBinController extends Controller
{
    public function deletedUsersList()
    {
        $deletedJobseekers = User::onlyTrashed()->orderBy('email')->get();
        return view('users/deleted_user_list', ['deletedJobseekers' => $deletedJobseekers]);    
    }

    public function deletedAdminsList()
    {
        $deletedJobseekers = Admin::onlyTrashed()->orderBy('email')->get();
        return view('admins/deleted_admins_list', ['deletedAdmins' => $deletedJobseekers]);    
    }

    public function deletedCarsList()
    {
        $carList = Inventory::onlyTrashed()->orderBy('created_at','DESC')->where('type',0)->get();
        return view('sells/car/deleted_car_list')->with('carList',$carList);
    }

    public function deletedMotosList()
    {
        $motoList = Inventory::onlyTrashed()->orderByDesc('id')->where('type',1)->get();
        return view('sells/moto/deleted_motos_list')->with('deletedAdmins',$motoList);  
    }

    public function deletedPoweEquipmentList()
    {
        $equipments = Inventory::onlyTrashed()->orderByDesc('id')->where('type',2)->get();

        return view('sells/power_equipment/deleted_power_equipment_list')->with('equipments',$equipments);  
    }
    
    public function deleteAutoMotorPartList()
    {
        $auto_and_moto_parts = Inventory::onlyTrashed()->orderByDesc('id')->where('type',3)->get();
        return view('sells/auto_moto_parts/deleted_auto_moto_parts_list')->with('auto_and_moto_parts',$auto_and_moto_parts);
    }

    public function deletedMakeList()
    {
        $makeList = MdBrand::onlyTrashed()->orderByDesc('id')->get();
        return view('vehicle/make_vehicle/deleted_make_list', [ 'makeList' => $makeList ]);
    }

    public function deletedModelList()
    {  
        $modelList = MdModel::onlyTrashed()->orderByDesc('id')->with('make')->get();
        return view('vehicle/model_vehicle/deleted_model_list',[ 'modelList' => $modelList ]);
    } 

    public function deleteAutoCategoryList()
    {  
        $categories = AutoAndMotoPartsCategory::onlyTrashed()->get();
        return view('auto_and_moto_parts_categories.deleted_cat_list')->with(['categories'=>$categories]); 
    }

    public function deleteAutoSubCategoryList()
    {  
        $sub_categories = AutoMotorSubCategory::onlyTrashed()->with('category')->get(); 
        return view('auto_and_moto_parts_categories.sub_categories.deleted_sub_list')->with(['sub_categories'=>$sub_categories]);
    }

    public function deleteEngineList()
    {
        $deletedJobseekers = Engine::onlyTrashed()->get();  
        return view('vehicle/engine/deleted_engine_list', ['sub_categories' => $deletedJobseekers]);
    } 

    public function deleteEqCatList()
    {
        $equipment_categories = PowerEquipmentCategory::onlyTrashed()->get();
        return view('power_equipment_categories.deleted_cat_list')->with(['equipment_categories'=>$equipment_categories]);
    }

    public function deleteEqSubCatList()
    {
        $sub_categories = PowerEquipmentSubCategory::onlyTrashed()->with('category')->get(); 
        return view('power_equipment_categories.sub_categories.deleted_su_cat_list')->with(['deletedAdmins'=>$sub_categories]);
    }
    
    public function deletePlanList()
    {
        $categories = ExtendedWarrantyPlan::onlyTrashed()->get();
        return view('extended_warranty.plans.deleted_plan_list')->with(["deletedAdmins" => $categories]);
    }
    
    public function deleteTrimList()
    {
        $categories = Trim::onlyTrashed()->get();
        return view('vehicle/trim/deleted_trim_list')->with(["deletedAdmins" => $categories]);
    }
    
    public function deleteStyleList()
    {
        $categories = Style::onlyTrashed()->get();
        return view('extended_warranty/style/deleted_style_list')->with(['deletedAdmins'=>$categories]);
    }

    public function deleteRoleList()
    {
        $roles = Role::onlyTrashed()->where('id', '!=', 1)->get();
        return view('roles/deleted_roles_list', ['deletedRoles' => $roles]);
    }

    public function deletedCoupons()
    {
        $categories = Coupon::onlyTrashed()->get();
        return view('/coupon/deleted_coupon')->with(['deletedAdmins'=>$categories]);
    }

    public function deleteServiceList()
    {
        $categories = RepairService::onlyTrashed()->get();
        return view('/auto_moto_repair/deleted_repair_service')->with(['services'=>$categories]);
    }

    public function deleteServiceCategoryList()
    {
        $categories = RepairServiceCategory::onlyTrashed()->get();
        return view('/auto_moto_repair/category/deleted_cat_list')->with(['categories'=>$categories]);
    }

    public function deleteComponentList()
    {
        $categories = ExtendedWarrantyCoveredComponent::onlyTrashed()->get();
        return view('/extended_warranty/component_covered/deleted_component_list')->with(['categories'=>$categories]);
    }
}
