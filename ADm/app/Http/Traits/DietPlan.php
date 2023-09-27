<?php

namespace App\Http\Traits;

use App\Models\UserDietPlanSubscription;
use App\Models\PaymentTransaction;

trait DietPlan {

    /**
     * Function: setDietPlan
     * Functionality: This function assign/set diet plan subscription
     * for the user.
     *
     * @param object $paymentId
     *
     * @return bool
     */

    public function setDietPlan($paymentId)
    {

       $userDietSubs = PaymentTransaction::where('razorpay_payment_id', $paymentId)->with('userDietPlan')->first();

       if ($userDietSubs->payment_for_id == config('common.models.diet_plan_subscriptions.specialized_plan_id') && $userDietSubs->payment_for == 'diet_plans'){
                $data = [
                    'expire_at' => calculateExpireTime('twenty_years'),
                    'diet_plan_subscription_id' => $userDietSubs->payment_for_id,
                    'diet_id' => request()->diet_id ?? request()->sub_plan_id,
                    'time_period' => $userDietSubs->payment_for_time_period,
                    'payment_transaction_id' => $userDietSubs->id,
                    'user_id' => auth()->id(),
                ];
                UserDietPlanSubscription::createDietPlan($data);
       } else {
           if ($userDietSubs->userDietPlan == null) {

                $data = [
                    'expire_at' => now()->addMonth($userDietSubs->payment_for_time_period),
                    'diet_plan_subscription_id' => $userDietSubs->payment_for_id,
                    'time_period' => $userDietSubs->payment_for_time_period,
                    'payment_transaction_id' => $userDietSubs->id,
                    'user_id' => auth()->id(),
                ];

                UserDietPlanSubscription::createDietPlan($data);
            }
       }
    }
}
