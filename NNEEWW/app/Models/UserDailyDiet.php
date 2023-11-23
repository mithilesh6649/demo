<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyDiet extends Model
{
    use HasFactory; 
       const breakfast = 31;
       const lunch = 32;
       const snack = 33;
       const dinner = 34;
     public function userDiet()
    {
        return $this->hasMany(UserDiet::class);
    }
}
