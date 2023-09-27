<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $casts = ['ingredients' => 'json', 'instructions' => 'json'];

    protected $appends = ['recipe_info_html'];

    public function getRecipeInfoHtmlAttribute()
    {
        $html = '';
        $html .= "<h4>$this->title</h4><br><br>";
        $html .= "<h4>Description</h4><br><br>";
        $html .= "<p>$this->description</p><br><br>";
        $html .= "<h4>Ingredients</h4><br><br>";
        $html .= "<ul>";

        for ($i=0; $i<count($this->ingredients); $i++) {

            if ($this->ingredients[$i] != '') {

                $html .= "<li>".$this->ingredients[$i]."</li><br>";
            }
        }
        $html .= "</ul>";

        $html .= "<h4>Instructions</h4><br><br>";

        $html .= "<ul>";
        for ($j=0; $j<count($this->instructions); $j++) {

            if ($this->instructions[$j] != '') {

                $html .= "<li>".$this->instructions[$j]."</li><br>";
            }
        }
        $html .= "</ul>";
        return $html;
    }

    public function getRecipes($edamamFoodId)
    {
        return Recipe::select('recipes.*')
            ->join('food_recipe_maps', 'food_recipe_maps.recipe_id', 'recipes.id')
            ->join('foods', 'foods.id', 'food_recipe_maps.food_id')
            ->where('foods.edmam_food_id', $edamamFoodId)
            ->inRandomOrder()
            ->limit(1)
            ->first();
    }
}
