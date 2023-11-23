<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Recipe extends Model
{
    use HasFactory,SoftDeletes;

    public function RecipeCategory(){
        return $this->belongsTo(RecipeCategory::class,'recipe_category_id');
    }

    public function FoodRecipeMap(){
        return $this->hasOne(FoodRecipeMap::class);
    }
     public function getTagsAttribute($value)
    {
        return json_decode($value, true);
    } 
}
