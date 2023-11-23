<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecipeCategory extends Model
{
    use HasFactory,SoftDeletes;

    CONST ACTIVE_STATUS = '1';   
    static function ACTIVE_RECIPE_CATEGORY(){
        return  RecipeCategory::where('status',RecipeCategory::ACTIVE_STATUS)->orderBy('title')->get();
    }
}
