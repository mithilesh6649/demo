<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepTracker extends Model
{
    protected $fillable = ['step_count', 'user_id'];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    use HasFactory;
}
