<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    const IGNORE_CAT = ['most_selling','loyalty_treasures','current_offers'];

    public function menuItems(){
        return $this->hasMany(MenuItem::class,'cat_id','id');
    }

       public function BranchMenuCategory(){
        return $this->hasMany(BranchMenuCategory::class);
    }


        public static function singlecheckedBranch($brach_id,$menu_category_id)
    {
        $singlecheched=BranchMenuCategory::where(['branch_id'=>$brach_id,'menu_category_id'=>$menu_category_id])->count();
        return $singlecheched;
    }

    public static function checkedBranch($menu_category_id){
            
            $menu_category=BranchMenuCategory::where('menu_category_id',$menu_category_id)->count();
            $allbrach=Branch::where('status',1)->get()->count();

            if($menu_category==$allbrach)
            {
                return 1;
            }else
            {
                return 0;
            }
    }
   

 



}
 