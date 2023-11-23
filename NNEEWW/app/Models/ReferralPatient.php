<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ReferralPatient extends Model
{
    use HasFactory,SoftDeletes;

     public function getDiseasesAttribute($value)
    {
        return json_decode(json_decode($value),true);
    }
}
