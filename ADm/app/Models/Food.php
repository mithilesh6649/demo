<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'foods';

    protected $casts = ['is_edamam_food_added' => 'boolean'];

    // public function get

    protected $fillable = ['edmam_food_id', 'image', 'brand_name', 'brand_description', 'slug', 'serving_size', 'serving_type' , 'serving_size_in_gram', 'serving_container', 'calories', 'total_fat', 'saturated_fat', 'polyunsaturated_fat' , 'monounsaturated_fat', 'trans_fat', 'cholesterol', 'sodium', 'potassium', 'total_carbohydrate' , 'sugar', 'added_sugar', 'is_edamam_food_added', 'sugar_alcohol', 'protein', 'vitamin_a', 'vitamin_b_6' , 'vitamin_b_12', 'vitamin_c', 'vitamin_d', 'calcium', 'iron', 'total_fat_unit', 'saturated_fat_unit', 'polyunsaturated_fat_unit', 'monounsaturated_fat_unit', 'trans_fat_unit', 'cholesterol_unit', 'sodium_unit', 'potassium_unit', 'total_carbohydrate_unit', 'sugar_unit', 'added_sugar_unit', 'sugar_alcohol_unit', 'protein_unit', 'vitamin_a_unit', 'vitamin_b_6_unit', 'vitamin_b_12_unit', 'vitamin_c_unit', 'vitamin_d_unit', 'calcium_unit', 'iron_unit', 'dietary_fibre', 'dietary_fibre_unit', 'magnesium', 'magnesium_unit', 'zinc', 'zinc_unit', 'phosphorus', 'phosphorus_unit', 'thiamin', 'thiamin_unit', 'riboflavin', 'riboflavin_unit', 'niacin', 'niacin_unit', 'folate_dfe', 'folate_dfe_unit', 'folate_food', 'folate_food_unit', 'folic', 'folic_unit', 'vitamin_k', 'vitamin_k_unit', 'water', 'water_unit', 'fiber', 'fiber_unit', 'is_edamam_food_added'];

    public function userDiet()
    {
        return $this->hasOne(UserDiet::class);
    }

    public function userFavFood()
    {
        return $this->hasOne(UserFavouriteFood::class);
    }

    public function recipe()
    {
        return $this->hasManyThrough(Recipe::class, FoodRecipeMap::class, 'food_id', 'id', 'id', 'recipe_id');
    }

    public function saveFood($foodNutrients = [])
    {
        return Food::firstOrCreate(
            ['edmam_food_id' => request()->edmam_food_id], $foodNutrients);
    }
}
