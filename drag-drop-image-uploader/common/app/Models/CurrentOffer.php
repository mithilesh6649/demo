<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class CurrentOffer extends Model
{
    use HasFactory;
     
     protected $fillable=['items_id','offer_name','current_offer_type','amount','branch_id','status'];

     protected $appends=['branchs'];
 
     
     public function getBranchsAttribute($value)
     {
        return $branch_id=json_decode($this->branch_id);
     }

     public function brachlist()
     {
        return $this->hasMany(CurrentOfferBranch::class);
     }

     public static function checkedBranch($offer_id)
     {
         $branch=Branch::where('status',1)->count();
         $data=CurrentOfferBranch::where('current_offer_id',$offer_id)->count();
         if($branch==$data)
         {
             return 1;
         }
         else
         {
            return 0;
         }
     } 
     public static function checksinglebrach($offer_id,$branch_id)
     {
       $offer_branch=CurrentOfferBranch::where(['branch_id'=>$branch_id,'current_offer_id'=>$offer_id])->count();
      
      if($offer_branch)
      {
         return 1;
      }
      else
      {
         return 0;
      }
     }


}
