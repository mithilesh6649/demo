<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PulseTracker extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime'
    ];

    protected $fillable = ['user_id', 'bpm'];
}
