<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class HealthLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('health_labels')->truncate();

        \DB::table('health_labels')->insert([
            [
                'title' => 'Alcohol-free',
                'slug' => 'alcohol-free',
                'value' => 'ALCOHOL_FREE'
            ],
            [
                'title' => 'Immune-Supportive',
                'slug' => 'immuno-supportive',
                'value' => 'IMMUNE_SUPPORTIVE'
            ],
            [
                'title' => 'Alcohol-Cocktail',
                'slug' => 'alcohol-cocktail',
                'value' => 'ALCOHOL_COCKTAIL'
            ],
            [
                'title' => 'Celery-free',
                'slug' => 'celery-free',
                'value' => 'CELERY_FREE'
            ],
            [
                'title' => 'Crustcean-Free',
                'slug' => 'crustacean-free',
                'value' => 'CRUSTACEAN_FREE'
            ],
            [
                'title' => 'Dairy-Free',
                'slug' => 'dairy-free',
                'value' => 'DAIRY_FREE'
            ],
            [
                'title' => 'DASH',
                'slug' => 'DASH',
                'value' => 'DASH'
            ],
            [
                'title' => 'Egg-Free',
                'slug' => 'egg-free',
                'value' => 'EGG_FREE'
            ],
            [
                'title' => 'Fish-Free',
                'slug' => 'fish-free',
                'value' => 'FISH_FREE'
            ],
            [
                'title' => 'FODMAP-Free',
                'slug' => 'fodmap-free',
                'value' => 'FODMAP_FREE'
            ],
            [
                'title' => 'Gluten-Free',
                'slug' => 'gluten-free',
                'value' => 'GLUTEN_FREE'
            ],
            [
                'title' => 'Keto-Friendly',
                'slug' => 'keto-friendly',
                'value' => 'KETO_FRIENDLY'
            ],
            [
                'title' => 'Kidney-Friendly',
                'slug' => 'kidney-friendly',
                'value' => 'KIDNEY_FRIENDLY'
            ],
            [
                'title' => 'Kosher',
                'slug' => 'kosher',
                'value' => 'KOSHER'
            ],
            [
                'title' => 'Low Potassium',
                'slug' => 'low-potassium',
                'value' => 'LOW_POTASSIUM'
            ],
            [
                'title' => 'Low Sugar',
                'slug' => 'low-sugar',
                'value' => 'LOW_SUGAR'
            ],
            [
                'title' => 'Lupine-Free',
                'slug' => 'lupine-free',
                'value' => 'LUPINE_FREE'
            ],
            [
                'title' => 'Mediterranean',
                'slug' => 'Mediterranean',
                'value' => 'MEDITERRANEAN'
            ],
            [
                'title' => 'Mollusk-Free',
                'slug' => 'mollusk-free',
                'value' => 'MOLLUSK_FREE'
            ],
            [
                'title' => 'Mustard-Free',
                'slug' => 'mustard-free',
                'value' => 'MUSTARD_FREE'
            ],
            [
                'title' => 'No oil added',
                'slug' => 'No-oil-added',
                'value' => 'NO_OIL_ADDED'
            ],
            [
                'title' => 'Paleo',
                'slug' => 'paleo',
                'value' => 'PALEO'
            ],
            [
                'title' => 'Peanut-Free',
                'slug' => 'peanut-free',
                'value' => 'PEANUT_FREE'
            ],
            [
                'title' => 'Pescatarian',
                'slug' => 'pecatarian',
                'value' => 'PECATARIAN'
            ],
            [
                'title' => 'Pork-Free',
                'slug' => 'pork-free',
                'value' => 'PORK_FREE'
            ],
            [
                'title' => 'Red-Meat-Free',
                'slug' => 'red-meat-free',
                'value' => 'RED_MEAT_FREE'
            ],
            [
                'title' => 'Sesame-Free',
                'slug' => 'sesame-free',
                'value' => 'SESAME_FREE'
            ],
            [
                'title' => 'Shellfish-Free',
                'slug' => 'sellfish-free',
                'value' => 'SELLFISH_FREE'
            ],
            [
                'title' => 'Soy-Free',
                'slug' => 'soy-free',
                'value' => 'SOY_FREE'
            ],
            [
                'title' => 'Sugar-Conscious',
                'slug' => 'sugar-conscious',
                'value' => 'SUGAR_CONSCIOUS'
            ],
            [
                'title' => 'Sulfite-Free',
                'slug' => 'sulfite-free',
                'value' => 'SULFITE_FREE'
            ],
            [
                'title' => 'Tree-Nut-Free',
                'slug' => 'tree-nut-free',
                'value' => 'TREE_NUT_FREE'
            ],
            [
                'title' => 'Vegan',
                'slug' => 'vegan',
                'value' => 'VEGAN'
            ],
            [
                'title' => 'Vegetarian',
                'slug' => 'vegetarian',
                'value' => 'VEGETARIAN'
            ],
            [
                'title' => 'Wheat-Free',
                'slug' => 'wheat-free',
                'value' => 'WHEAT_FREE'
            ],
            [
                'title' => 'Fat-Free',
                'slug' => 'fat-free',
                'value' => 'FAT_FREE'
            ],
            [
                'title' => 'Shellfish-Free',
                'slug' => 'shellfish-free',
                'value' => 'SHELLFISH_FREE'
            ],
             [
                'title' => 'No-Sugar-Added',
                'slug' => 'no-sugar-added',
                'value' => 'NO_SUGAR_ADDED'
            ],
        ]);
    }
}
