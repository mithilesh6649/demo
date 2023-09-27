<?php

namespace App\Observers;

use App\Models\HealthStatus;

class HealthStatusObserver
{
    /**
     * Handle the HealthStatus "created" event.
     *
     * @param  \App\Models\HealthStatus  $healthStatus
     * @return void
     */
    public function created(HealthStatus $healthStatus)
    {
        if (request()->has('weight') && request()->has('weight_unit')) {

            \App\Models\WeightTracker::create(['user_id' => auth()->id(), 'weight' => $healthStatus->weight, 'weight_unit' => $healthStatus->weight_unit]);
        }
    }

    /**
     * Handle the HealthStatus "updated" event.
     *
     * @param  \App\Models\HealthStatus  $healthStatus
     * @return void
     */
    public function updated(HealthStatus $healthStatus)
    {
        if (request()->has('weight') && request()->has('weight_unit')) {

            $weightTracker = \App\Models\WeightTracker::where('user_id', auth()->id())->first();

            if ($weightTracker == null) {

                $weightTracker = new \App\Models\WeightTracker;
                $weightTracker->user_id = auth()->id();
            }

            $weightTracker->weight = $healthStatus->weight;
            $weightTracker->weight_unit = $healthStatus->weight_unit;
            $weightTracker->save();
        }
    }

    /**
     * Handle the HealthStatus "deleted" event.
     *
     * @param  \App\Models\HealthStatus  $healthStatus
     * @return void
     */
    public function deleted(HealthStatus $healthStatus)
    {
        //
    }

    /**
     * Handle the HealthStatus "restored" event.
     *
     * @param  \App\Models\HealthStatus  $healthStatus
     * @return void
     */
    public function restored(HealthStatus $healthStatus)
    {
        //
    }

    /**
     * Handle the HealthStatus "force deleted" event.
     *
     * @param  \App\Models\HealthStatus  $healthStatus
     * @return void
     */
    public function forceDeleted(HealthStatus $healthStatus)
    {
        //
    }

    private function setWeightTracker($healthStatus)
    {

    }
}
