<?php

namespace App\Http\Traits;

use App\Models\DietPlanSubscription;
use App\Models\TraitsPrice;
use App\Models\MdDropdown;
use App\Models\Test;
use App\Models\Diet;
trait Payment {

   public function getDietPlanAmount($dietPlanId = null,$dietId = null,$duration = null)
    {
        //NOTE: Old code for diet plans
        // $planId = $dietPlanId ?? request()->diet_plan_id;
        // $timePeriod = $duration ?? $this->extractTimePeriod(request()->time_period);

        // if ($planId == 4 && request()->diet_id != null) {

        //     return Diet::where(['id' => request()->diet_id])->value('amount');
        // }

        $planId = $dietPlanId ?? request()->diet_plan_id;
        $timePeriod = $duration ?? request()->time_period;

        if ($planId == config('common.models.diet_plan_subscriptions.specialized_plan_id') && request()->sub_plan_id != null) {

            return Diet::where(['id' => request()->sub_plan_id])->value('amount');

        } else if ($planId == config('common.models.diet_plan_subscriptions.dna_metabolic_id') || $planId == config('common.models.diet_plan_subscriptions.metabolic_plan_id') && request()->sub_plan_id != null) {

            $subPlanPricing = Diet::whereId(request()->sub_plan_id)->with('singlePrice', function ($qr) use ($timePeriod) {
                $qr->where('duration', $timePeriod)->first();
            })->first();

            return $subPlanPricing->singlePrice->amount_after_discount;
        }

        // return DietPlanSubscription::where(['id' => $planId])->value($timePeriod);
    }

    private function extractTimePeriod($timePeriod)
    {
        if ($timePeriod == "monthly") {

            $duration = "monthly_amount";

        } else if ($timePeriod == "quaterly") {

            $duration = "quaterly_amount";

        } else {

            $duration = "yearly_amount";
        }




        return $duration;
    }

    public function getTestAmount()
    {
        switch (request()->type) {

            case '1':
            $amount = Test::whereIn('id', request()->test_id)->sum('amount');
            break;

            case '2':
            $amount = MdDropdown::where('slug', 'any_two_pricing')->value('value');
            break;

            case '3':
            $amount = MdDropdown::where('slug', 'all_six_pricing')->value('value');
            break;
        }

        if (request()->additional_trait == "true") {

            $amount = (float) $amount + (float) TraitsPrice::where('slug', request()->trait_type)->value('price');
        }

        return $amount;
    }
}
