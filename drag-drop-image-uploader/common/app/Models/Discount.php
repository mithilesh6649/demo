<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiscountBranch;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory,SoftDeletes;
 
    public function discountitem(){
        return $this->hasMany(DiscountItem::class);
    }

    public function discountbranch(){
        return $this->hasMany(DiscountBranch::class);
    }

    public static function checkIfCategorySelected($category_id,$discount_id){

        $discount = DiscountItem::where(['menu_category_id'=>$category_id,'discount_id'=>$discount_id])->count();
         $cat_menucount=MenuItem::where('cat_id',$category_id)->count();

         if($discount>0 && $cat_menucount>0)
         {
            if($discount==$cat_menucount)
            {
            return 1;
            }
         }else
         {
            return 0;
         }
      
    }

    public static function checkBranchMenu($category_id,$discount_id,$menuitem_id)
    {
        $discount = DiscountItem::where(['menu_category_id'=>$category_id,'discount_id'=>$discount_id])->count();
         $cat_menucount=MenuItem::where('cat_id',$category_id)->count();

         if($discount==$cat_menucount)
         {
            return 1;
         }else
         {
            $m_count=DiscountItem::where(['discount_id'=>$discount_id,'menu_category_id'=>$category_id,'menu_item_id'=>$menuitem_id])->count();

            return $m_count;
         }
    }

    public static function singlecheckedBranch($brach_id,$discount_id)
    {
        $singlecheched=DiscountBranch::where(['branch_id'=>$brach_id,'discount_id'=>$discount_id])->count();
        return $singlecheched;
    }

    public static function checkedBranch($discount_id){
            
            $discount_branch=DiscountBranch::where('discount_id',$discount_id)->count();
            $allbrach=Branch::where('status',1)->get()->count();

            if($discount_branch==$allbrach)
            {
                return 1;
            }else
            {
                return 0;
            }
    }

}
