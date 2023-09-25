<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DailyPettyExpenseSubCategory extends Model
{
    use HasFactory,SoftDeletes;

      protected $guarded = [];
      public const ACTIVE = 1;

      public function category(){
        return $this->belongsTo(DailyPettyExpenseCategory::class,'category_id');
    }

}
