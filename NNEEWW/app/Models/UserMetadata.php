<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetadata extends Model
{
    use HasFactory;

       public function getFamilyMedicalHistoryAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getDietaryTypeOfDietAttribute($value)
    {
        return json_decode($value, true);
    }
}
