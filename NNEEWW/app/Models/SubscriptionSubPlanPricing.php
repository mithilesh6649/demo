<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionSubPlanPricing extends Model
{
    use HasFactory;

    protected $fillable = ['diet_id','duration','amount','discount','status'];

    public function subPlanPricingFeatureMap(){
        return $this->hasMany(SubPlanPricingFeatureMap::class);
    }
}
