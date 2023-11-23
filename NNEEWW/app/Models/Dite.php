<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dite extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'diets';
    const DIET = 1;
    const PLANS = 2;

    protected $fillable = ['diet_category_id','title','amount','image','description','status'];

    public function DiteCategory(){
        return $this->belongsTo(DiteCategory::class,'diet_category_id');
    }

    public function dietSubPlanSubscriptionMap(){
        return $this->hasOne(DietSubPlanSubscriptionMap::class,'diet_id');
    }

     public function subPlanFeatureMap(){
        return $this->hasMany(SubPlanFeatureMap::class,'diet_id');
    }
}
