<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutOfferItem extends Model
{
    use HasFactory;

     public function MenuItem(){
        return $this->hasMany(MenuItem::class,'id','menu_item_id');
    }

    public static function getcatName($cat_id)
    {
      $cat_details=MenuCategory::where('id',$cat_id)->first();
       return optional($cat_details)->name_en;
    }
    public static function getMenuItem($menu_item)
    {
       $menu_details=MenuItem::where('id',$menu_item)->first();
      return optional($menu_details)->item_name_en;
    }
      



}
  