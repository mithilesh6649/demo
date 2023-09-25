<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends Model
{
    use HasFactory,SoftDeletes;

     public function CouponCodeBranch() {
        return $this->hasMany(CouponCodeBranch::class);
    }


     public function CouponCodeItem() {
        return $this->hasMany(CouponCodeItem::class);
    }

   
     public function MenuItem() {
        return $this->hasOne(MenuItem::class,'id','menu_item_id');
    }



     public static function checkIfCategorySelected($category_id,$discount_id){

        $discount = CouponCodeItem::where(['menu_category_id'=>$category_id,'coupon_code_id'=>$discount_id])->count();
          $cat_menucount=MenuItem::where('cat_id',$category_id)->count();

         if($discount==$cat_menucount)
         {
           return 1;
         }else
         {
            return 0;
         }
      
    }



     public static function checkBranchMenu($category_id,$discount_id,$menuitem_id)
    {
        $discount = CouponCodeItem::where(['menu_category_id'=>$category_id,'coupon_code_id'=>$discount_id])->count();
         $cat_menucount=MenuItem::where('cat_id',$category_id)->count();

         if($discount==$cat_menucount)
         {
            return 1;
         }else
         {
            $m_count=CouponCodeItem::where(['coupon_code_id'=>$discount_id,'menu_category_id'=>$category_id,'menu_item_id'=>$menuitem_id])->count();

            return $m_count;
         }
    }

   



 
     
 
      public static function singlecheckedBranch($brach_id,$discount_id)
    {
        $singlecheched=CouponCodeBranch::where(['branch_id'=>$brach_id,'discount_id'=>$discount_id])->count();
        return $singlecheched;
    }

    public static function checkedBranch($coupon_code_id){
            
            $discount_branch=CouponCodeBranch::where('coupon_code_id',$coupon_code_id)->count();
            $allbrach=Branch::where('status',1)->get()->count();

            if($discount_branch==$allbrach)
            {
                return 1;
            }else
            {
                return 0;
            }
    } 









     public static function checkedcategory($offer_id,$cat_id)
    {
           $count=CouponCodeItem::where(['coupon_code_id'=>$offer_id,'menu_category_id'=>$cat_id])->count();

           $cat_menucount=MenuItem::where('cat_id',$cat_id)->count();
           if($count==$cat_menucount)
           {
            return 1;
           }else
           {
            return 0;
           }
    }

    public static function checkedmenuitem($offer_id,$menuitem)
    {
      $count=CouponCodeItem::where(['coupon_code_id'=>$offer_id,'menu_item_id'=>$menuitem])->count();

       if($count>0)
       {
         return 1;
       }else
       {
         return 0;
       }
    }

    public static function checksinglebranch($branch_id,$offer_id){
      $branch=CouponCodeBranch::where(['coupon_code_id'=>$offer_id,'branch_id'=>$branch_id])->count();
      if($branch>0)
      {
        return 1;
      }else
      {
        return 0;
      }
    }


    public static function checkallbranch($offer_id)
    {
        $check_branch=CouponCodeBranch::where('coupon_code_id',$offer_id)->count();
        $data=Branch::count();
        if($data==$check_branch)
        {
          return 1;
        }
        else
        {
          return 0;
        }

    }


     
    

}
