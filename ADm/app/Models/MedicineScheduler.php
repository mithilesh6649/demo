<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineScheduler extends Model
{
    use HasFactory;

    protected $fillable = ['medicine_tracker_id', 'week_days'];
}
