<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlanSubscription extends Model
{
    use HasFactory;

    public function DietSubscriptionFeatureMap(){
        return $this->hasMany(DietSubscriptionFeatureMap::class);
    }

    public function userDietPlanSubscription(){
        return $this->hasOne(UserDietPlanSubscription::class);
    }
  
    function getDietPlanName($id){
       return self::where('id',$id)->value('name');
    }
    // public function paymentTransaction(){
    //     return $this->hasMany(PaymentTransaction::class,'payment_for_id','id')->where('payment_for','diet_plans');
    // }
}
