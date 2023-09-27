<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDietPlanSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_transaction_id', 'diet_plan_subscription_id','diet_id','time_period', 'expire_at', 'status'];

    public function scopeStatus($qr)
    {
        return $qr->where('status', 1);
    }

    public function dietPlans()
    {
        return $this->belongsToMany(DietPlanSubscription::class);
    }

    public function specializedDiet()
    {
        return $this->hasMany(UserSpecializedDietPlanMap::class);
    }

    public function createDietPlan($data)
    {
        UserDietPlanSubscription::create($data);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function planTimePeriod($planId)
    {
        $monthly = $quaterly = $yearly = false;

        $planInfo = UserDietPlanSubscription::where(['user_id' => auth()->id(), 'diet_plan_subscription_id' => $planId])->whereDate('expire_at', '>', now())->pluck('time_period')->toArray();

        if (count($planInfo) != 0) {

            $quaterly = in_array('quaterly', $planInfo) ? true : false;
            $monthly = in_array('monthly', $planInfo) ? true : false;
            $yearly = in_array('yearly', $planInfo) ? true : false;
        }

        return [
            'monthly' => $monthly,
            'quaterly' => $quaterly,
            'yearly' => $yearly,
        ];
    }

    public static function boot()
    {
        parent::boot();

        UserDietPlanSubscription::observe(new \App\Observers\UserDietPlanSubsObserver);

        static::created(function($dietPlan) {
            $dietPlan->status = 1;
            $dietPlan->save();
        });

    }
}
