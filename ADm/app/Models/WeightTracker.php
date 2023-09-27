<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WeightTracker extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'weight', 'weight_unit'];
}
