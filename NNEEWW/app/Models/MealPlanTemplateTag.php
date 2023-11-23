<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanTemplateTag extends Model
{
    use HasFactory;

    public function healthComplaint(){
        return  $this->hasOne(HealthComplaint::class,'id')->select('id','name');
      }
}
