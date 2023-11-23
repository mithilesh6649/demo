<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanTemplate extends Model
{
    use HasFactory;

    public function mealPlanTemplateTag(){
      return  $this->hasMany(MealPlanTemplateTag::class);
    }

    public function  Nutritionist(){
     return $this->belongsTo(Nutritionist::class,'template_created_by_id');
   }

}
