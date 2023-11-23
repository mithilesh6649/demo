<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function ReviewComment(){
        return $this->hasMany(ReviewComment::class);
    }

    public function ReviewNutritionstDetails(){
        return $this->hasOne(Nutritionist::class,'id');
    }


}
