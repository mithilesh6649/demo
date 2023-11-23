<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdDropdown extends Model
{
    use HasFactory;

    // protected $appends = ['vehicle_count','cars_count','motos_count','advertising_count','advertising_cars_count','advertising_motos_count'];

    // public function getVehicleCountAttribute(){
    //     $types = [0,1];
    // 	if($this->belongs_to=='extra_features'){
	//     	return Inventory::where($this->slug,1)->whereIn('type',$types)->count();
    // 	}else{
	//     	return Inventory::where($this->belongs_to,$this->value)->whereIn('type',$types)->count();
    // 	}
    // }
    // public function getCarsCountAttribute(){
    //     // $types = [0,1];
    //     if($this->belongs_to=='extra_features'){
    //         return Inventory::where($this->slug,1)->where('type',0)->count();
    //     }else{
    //         return Inventory::where($this->belongs_to,$this->value)->where('type',0)->count();
    //     }
    // }
    // public function getMotosCountAttribute(){
    //     // $types = [0,1];
    //     if($this->belongs_to=='extra_features'){
    //         return Inventory::where($this->slug,1)->where('type',1)->count();
    //     }else{
    //         return Inventory::where($this->belongs_to,$this->value)->where('type',1)->count();
    //     }
    // }

    // public function getAdvertisingCountAttribute(){
    //     $types = [0,1];
    //     if($this->belongs_to=='extra_features'){
    //         return Inventory::where($this->slug,1)->where('is_advertising',1)->whereIn('type',$types)->count();
    //     }else{
    //         return Inventory::where($this->belongs_to,$this->value)->where('is_advertising',1)->whereIn('type',$types)->count();
    //     }
    // }
    // public function getAdvertisingCarsCountAttribute(){
    //     // $types = [0,1];
    //     if($this->belongs_to=='extra_features'){
    //         return Inventory::where($this->slug,1)->where('is_advertising',1)->where('type',0)->count();
    //     }else{
    //         return Inventory::where($this->belongs_to,$this->value)->where('is_advertising',1)->where('type',0)->count();
    //     }
    // }
    // public function getAdvertisingMotosCountAttribute(){
    //     // $types = [0,1];
    //     if($this->belongs_to=='extra_features'){
    //         return Inventory::where($this->slug,1)->where('is_advertising',1)->where('type',1)->count();
    //     }else{
    //         return Inventory::where($this->belongs_to,$this->value)->where('is_advertising',1)->where('type',1)->count();
    //     }
    // }

    // public static function getCarFeatures($id){
    // 	return Self::where('parent_id',$id)->where('type',0)->get();
    // }
    // public static function getMotoFeatures($id){
    //     return Self::where('parent_id',$id)->where('type',1)->get();
    // }

    // public static function getCarSpecifications($id){
    //     return Self::where('parent_id',$id)->where('type',0)->get();
    // }

   
}
