<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class PaymentTransaction extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function dietPlanSubscription(){
        return $this->belongsTo(DietPlanSubscription::class,'payment_for_id','id');
    }

    public function userDietPlanSubscription(){
        return $this->belongsTo(UserDietPlanSubscription::class,'id','payment_transaction_id');
    }

 //Plan test two six etc name
    public function UserTest(){
       return $this->hasMany(UserTest::class);
    }

     public function UserTrait(){
       return $this->hasMany(UserTrait::class);
    }


      public function paymentTransactionItem(){
       return $this->hasMany(PaymentTransactionItem::class);
    }



    

    

} 
