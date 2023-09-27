<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $appends = ['amount_after_discount'];

    public function getAmountAfterDiscountAttribute()
    {
        if ($this->discount !== null || $this->amount !== null) {

            return round($this->amount - ($this->amount * $this->discount)/100);
        }
    }

    public function pricing()
    {
        return $this->hasMany(SubPlanPricing::class);
    }

    public function singlePrice()
    {
        return $this->hasOne(SubPlanPricing::class);
    }

    public function subPlanFeatures()
    {
        return $this->hasManyThrough(Feature::class, SubPlanFeatureMap::class, 'diet_id', 'id', 'id', 'feature_id')->where('features.type', 2);
    }
}
