<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiet extends Model
{
    use HasFactory;

     public function food()
    {
        return $this->hasOne(Food::class,'id','food_id');
    }
 

    public function mealType()
    {
        return $this->hasOne(MdDropdown::class,'id','meal_type_id');
    }
}
