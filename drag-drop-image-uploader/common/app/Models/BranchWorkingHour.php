<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchWorkingHour extends Model
{
    use HasFactory , SoftDeletes;


     public function getStartingHourAttribute($value)
    {
        return date('g:i A', strtotime($value));
    }


     public function getEndingHourAttribute($value)
    {
        return date('g:i A', strtotime($value));
    }


}
