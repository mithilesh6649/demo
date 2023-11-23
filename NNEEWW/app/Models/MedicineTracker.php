<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineTracker extends Model
{
    use HasFactory;


    public function MedicineScheduler() {
        return $this->hasMany(MedicineScheduler::class);
    }


    public function MedicineReminder() {
        return $this->hasMany(MedicineReminder::class);
    }

    public function MedicineType() {
        return $this->belongsTo(MdDropdown::class,'medicine_type_id');
    }

    public function MedicineServing() {
        return $this->belongsTo(MdDropdown::class,'serving_unit_id');
    }
}
