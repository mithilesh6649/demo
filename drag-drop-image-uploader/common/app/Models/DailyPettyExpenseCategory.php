<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
class DailyPettyExpenseCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    public const ACTIVE = 1;

    public function subcategories(){
        return $this->hasMany(DailyPettyExpenseSubCategory::class,'category_id');
    }
   
 


}
