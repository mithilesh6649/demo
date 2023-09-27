<?php

namespace App\Observers;

use App\Models\MedicineTracker;

class MedicineTrackerObserver
{
    /**
     * Handle the MedicineTracker "created" event.
     *
     * @param  \App\Models\MedicineTracker  $medicineTracker
     * @return void
     */
    public function created(MedicineTracker $medicineTracker)
    {
    }

    /**
     * Handle the MedicineTracker "updated" event.
     *
     * @param  \App\Models\MedicineTracker  $medicineTracker
     * @return void
     */
    public function updated(MedicineTracker $medicineTracker)
    {
    }

    /**
     * Handle the MedicineTracker "deleted" event.
     *
     * @param  \App\Models\MedicineTracker  $medicineTracker
     * @return void
     */
    public function deleted(MedicineTracker $medicineTracker)
    {
        //
    }

    /**
     * Handle the MedicineTracker "restored" event.
     *
     * @param  \App\Models\MedicineTracker  $medicineTracker
     * @return void
     */
    public function restored(MedicineTracker $medicineTracker)
    {
        //
    }

    /**
     * Handle the MedicineTracker "force deleted" event.
     *
     * @param  \App\Models\MedicineTracker  $medicineTracker
     * @return void
     */
    public function forceDeleted(MedicineTracker $medicineTracker)
    {
        //
    }
}
