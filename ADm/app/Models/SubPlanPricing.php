<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPlanPricing extends Model
{
    use HasFactory;

    protected $table = 'subscription_sub_plan_pricings';

    protected $appends = ['amount_after_discount', 'duration_in_months'];

    public function getAmountAfterDiscountAttribute()
    {
        if ($this->discount !== null || $this->amount !== null) {

            return round($this->amount - ($this->amount * $this->discount)/100);
        }
    }

    public function subPlan()
    {
        return $this->hasOne(Diet::class, 'id', 'diet_id');
    }

    public function getDurationInMonthsAttribute()
    {
        return ($this->duration > 1) ? "$this->duration Months" : "$this->duration Month";
    }

    public function pricingSubPlanFeatures()
    {
        return $this->hasManyThrough(Feature::class, SubPlanPricingFeatureMap::class, 'subscription_sub_plan_pricing_id', 'id', 'id', 'feature_id')->where('features.type', 3);
    }
}
