<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nutritionist extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'web_users';
       // CONST ACTIVE_STATUS = '1';
        CONST INACIVE_STATUS = 6;
        CONST ACTIVE_STATUS = 5;  // Id From Statuses table


    public function NutritionistMetadata(){
        return $this->hasOne(NutritionistMetadata::class,'web_user_id','id');
    }

    public function UserAction() {
        return $this->hasOne(UserAction::class,'user_id')->where(['user_guard'=>'web_users']);
    }

    public function NutritionistDocuments(){
        return $this->hasMany(Document::class,'document_owner_id','id')->where(['document_owner_guard'=>'web_users']);
    }


    public function NutritionistSpecialization(){
        return $this->hasOne(NutritionistSpecializationMap::class,'web_user_id','id');
    }

    public function Appointment(){
        return $this->hasMany(Appointment::class,'invitee_id');
    }

      public function webUserAssociation(){
        return $this->hasMany(WebUserAssociation::class,'web_user_id');
    }
    
    public function Review(){
        return $this->hasOne(Review::class,'review_to_id')->where(['review_to_guard'=>'web_users','type'=>2]);
    }

    

    static function ACTIVE_NUTRITIONIST(){
        return  Nutritionist::get();
    }


}
  