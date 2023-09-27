<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineTracker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'medicine_name', 'medicine_type_id', 'dose_count', 'serving_unit_id', 'scheduler_type', 'start_date', 'end_date', 'status', 'schedule'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'boolean',
        'schedule' => 'boolean'
    ];

    public function medicineType()
    {
        return $this->belongsTo(MdDropdown::class, 'medicine_type_id', 'id');
    }

    public function medicineServingUnit()
    {
        return $this->belongsTo(MdDropdown::class, 'serving_unit_id', 'id');
    }

    public function medicineScheduler()
    {
        return $this->hasMany(MedicineScheduler::class);
    }

    public function manageMedicineTrackerData($data)
    {
        try {
            $medicineTracker = MedicineTracker::updateOrCreate(['user_id' => auth()->id(), 'id' => $data['medicine_id']], $data);

            if ($data['schedule']) {

                if (!is_null($data['doses'])) {

                    $medicineTracker->doses()->delete();

                    foreach ($data['doses'] as $dose) {
                        $medicineTracker->doses()->create(['medicine_tracker_id' => $medicineTracker->id, 'remind_time' => $dose['remind_time'], 'cron_run' => (now()->parse($dose['remind_time'])->format('H:i') < now()->format('H:i')) ? 1 : 0 ]);
                    }
                }

                if (!is_null($data['specific_days'])) {

                    $medicineTracker->medicineScheduler()->delete();

                    foreach ($data['specific_days'] as $specificDay) {

                        $medicineTracker->medicineScheduler()->create(['medicine_tracker_id' => $medicineTracker->id, 'week_days' => $specificDay]);
                    }
                }
            }

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function deleteMedicineTracker($medicineTrackerId)
    {
        MedicineTracker::whereId($medicineTrackerId)->delete();
    }

    public static function boot()
    {
        parent::boot();

        // MedicineTracker::observe(new \App\Observers\MedicineTrackerObserver);
    }

    public function doses()
    {
        return $this->hasMany(MedicineReminder::class);
    }
}
