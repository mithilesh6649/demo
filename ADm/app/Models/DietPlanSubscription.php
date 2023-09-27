<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlanSubscription extends Model
{
    use HasFactory;

    protected $casts = ['is_free' => 'boolean'];

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }

    public function features()
    {
        return $this->hasManyThrough(Feature::class, DietSubscriptionFeatureMap::class, 'diet_plan_subscription_id', 'id', 'id', 'feature_id');
    }

    public function subPlan()
    {
        return $this->hasManyThrough(Diet::class, SubDietPlanMap::class, 'diet_plan_subscription_id', 'id', 'id', 'diet_id');
    }

    public function singleSubPlan()
    {
        return $this->hasOneThrough(Diet::class, SubDietPlanMap::class, 'diet_plan_subscription_id', 'id', 'id', 'diet_id');
    }

    public function getPlan($planId)
    {
        try {

            return DietPlanSubscription::where('id', $planId)->with('features')->first();

        } catch (\Exception $err) {


        }
    }
}
