<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietSubPlanSubscriptionMap extends Model
{
    use HasFactory;
    protected $fillable = ['diet_id','diet_plan_subscription_id'];
    public function diet(){
        return $this->hasOne(Diet::class,'id','diet_id')->select(['id','title','description']);
    }
}
