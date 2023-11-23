<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HealthLabel;
class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = [
        'edmam_food_id',
        'is_edamam_food_added',
        'image',
        'brand_name',
        'brand_description',
        'slug',
        'total_weight',
        'total_weight_unit',
        'serving_size',
        'serving_type' ,
        'serving_size_in_gram',
        'serving_container',
        'calories',
        'total_fat',
        'saturated_fat',
        'polyunsaturated_fat' ,
        'monounsaturated_fat',
        'trans_fat',
        'cholesterol',
        'sodium',
        'potassium',
        'total_carbohydrate' ,
        'sugar',
        'added_sugar',
        'sugar_alcohol',
        'protein',
        'vitamin_a',
        'vitamin_b_6' ,
        'vitamin_b_12',
        'vitamin_c',
        'vitamin_d',
        'calcium',
        'iron',

        'selected_measure_uri',
        'total_weight',
        'total_weight_unit',

        'total_fat_unit',
        'saturated_fat_unit',
        'polyunsaturated_fat_unit',
        'monounsaturated_fat_unit',
        'trans_fat_unit',
        'cholesterol_unit',
        'sodium_unit',
        'potassium_unit',
        'total_carbohydrate_unit',
        'sugar_unit',
        'added_sugar_unit',
        'sugar_alcohol_unit',
        'protein_unit',
        'vitamin_a_unit',
        'vitamin_b_6_unit',
        'vitamin_b_12_unit',
        'vitamin_c_unit',
        'vitamin_d_unit',
        'calcium_unit',
        'iron_unit',
        'dietary_fibre',
        'dietary_fibre_unit',
        'magnesium',
        'magnesium_unit',
        'zinc',
        'zinc_unit',
        'phosphorus',
        'phosphorus_unit',
        'thiamin',
        'thiamin_unit',
        'riboflavin',
        'riboflavin_unit',
        'niacin',
        'niacin_unit',
        'folate_dfe',
        'folate_dfe_unit',
        'folate_food',
        'folate_food_unit',
        'folic',
        'folic_unit',
        'vitamin_k',
        'vitamin_k_unit',
        'water',
        'water_unit',
        'fiber',
        'fiber_unit',
    ];



    public function saveFood($foodData, $foodAdditionalData)
    {
        return Food::firstOrCreate(
            [
                'edmam_food_id' => $foodAdditionalData['food_id'],
                'serving_size' => $foodAdditionalData['servingSize'],
                'serving_type' => $foodAdditionalData['servingType'],

            ],
            [
                'brand_description' => $foodData['ingredients'][0]['parsed'][0]['food'] ?? null,
                'serving_size_in_gram' => null,
               // 'serving_container' => $foodData['ingredients'][0]['parsed'][0]['measure'] ?? null,
                'polyunsaturated_fat' => $foodData['totalNutrients']['FAPU']['quantity'] ?? 0,
                'monounsaturated_fat' => $foodData['totalNutrients']['FAMS']['quantity'] ?? 0,
                'total_carbohydrate' => $foodData['totalNutrients']['CHOCDF.net']['quantity'] ?? 0,
                'saturated_fat' => $foodData['totalNutrients']['FASAT']['quantity'] ?? 0,
                'sugar_alcohol' => $foodData['totalNutrients']['SUGAR.alcohol']['quantity'] ?? 0,
                'serving_size' =>  $foodData['ingredients'][0]['parsed'][0]['quantity'] ?? 0,
                 'selected_measure_uri' => $foodData['ingredients'][0]['parsed'][0]['measureURI'] ?? null,
                'total_weight' => $foodData['ingredients'][0]['parsed'][0]['weight'] ?? null,
               'serving_type' => $foodData['ingredients'][0]['parsed'][0]['measure'] ?? 0,
                'vitamin_b_12' => $foodData['totalNutrients']['VITB12']['quantity'] ?? 0,
                'added_sugar' => $foodData['totalNutrients']['SUGAR.added']['quantity'] ?? 0,
                'cholesterol' => $foodData['totalNutrients']['CHOLE']['quantity'] ?? 0,
                'vitamin_b_6' => $foodData['totalNutrients']['VITB6A']['quantity'] ?? 0,
                'brand_name' => $foodData['ingredients'][0]['parsed'][0]['food'] ?? null,
                'total_fat' => $foodData['totalNutrients']['FAT']['quantity'] ?? 0,
                'potassium' => $foodData['totalNutrients']['K']['quantity'] ?? 0,
                'vitamin_a' => $foodData['totalNutrients']['VITA_RAE']['quantity'] ?? 0,
                'vitamin_c' => $foodData['totalNutrients']['VITC']['quantity'] ?? 0,
                'vitamin_d' => $foodData['totalNutrients']['VITD']['quantity'] ?? 0,
                'trans_fat' => $foodData['totalNutrients']['FATRN']['quantity'] ?? 0,
                'calories' => $foodData['calories'] ?? 0,
                'image' => $foodAdditionalData['food_image'],
                'protein' => $foodData['totalNutrients']['PROCNT']['quantity'] ?? 0,
                'calcium' => $foodData['totalNutrients']['CA']['quantity'] ?? 0,
                'sodium' => $foodData['totalNutrients']['NA']['quantity'] ?? 0,
                'sugar' => $foodData['totalNutrients']['SUGAR']['quantity'] ?? 0,
                // 'slug' => $foodData['totalNutrients']['FAPU']['quantity'] ?? 0,
                'iron' => $foodData['totalNutrients']['FE']['quantity'] ?? 0,
                /////////

                'iron' => $foodData['totalNutrients']['FE']['quantity'] ?? 0,
                'polyunsaturated_fat_unit' => $foodData['totalNutrients']['FAPU']['unit'] ?? 0,
                'monounsaturated_fat_unit' => $foodData['totalNutrients']['FAMS']['unit'] ?? 0,
                'total_carbohydrate_unit' => $foodData['totalNutrients']['CHOCDF.net']['unit'] ?? 0,
                'saturated_fat_unit' => $foodData['totalNutrients']['FASAT']['unit'] ?? 0,
                'dietary_fibre_unit' => $foodData['totalNutrients']['FIBTG']['unit'] ?? 0,
                'sugar_alcohol_unit' => $foodData['totalNutrients']['SUGAR.alcohol']['unit'] ?? 0,
                'vitamin_b_12_unit' => $foodData['totalNutrients']['VITB12']['unit'] ?? 0,
                'cholesterol_unit' => $foodData['totalNutrients']['CHOLE']['unit'] ?? 0,
                'vitamin_b_6_unit' => $foodData['totalNutrients']['VITB6A']['unit'] ?? 0,
                'folate_food_unit' => $foodData['totalNutrients']['FOLFD']['unit'] ?? 0,
                'added_sugar_unit' => $foodData['totalNutrients']['SUGAR.added']['unit'] ?? 0,
                'riboflavin_unit' => $foodData['totalNutrients']['RIBF']['unit'] ?? 0,
                'folate_dfe_unit' => $foodData['totalNutrients']['FOLDFE']['unit'] ?? 0,
                'phosphorus_unit' => $foodData['totalNutrients']['P']['unit'] ?? 0,
                'magnesium_unit' => $foodData['totalNutrients']['MG']['unit'] ?? 0,
                'vitamin_k_unit' => $foodData['totalNutrients']['VITK1']['unit'] ?? 0,
                'trans_fat_unit' => $foodData['totalNutrients']['FATRN']['unit'] ?? 0,
                'potassium_unit' => $foodData['totalNutrients']['K']['unit'] ?? 0,
                'vitamin_a_unit' => $foodData['totalNutrients']['VITA_RAE']['unit'] ?? 0,
                'vitamin_c_unit' => $foodData['totalNutrients']['VITC']['unit'] ?? 0,
                'vitamin_d_unit' => $foodData['totalNutrients']['VITD']['unit'] ?? 0,
                'dietary_fibre' => $foodData['totalNutrients']['FIBTG']['quantity'] ?? null,
                'protein_unit' => $foodData['totalNutrients']['PROCNT']['unit'] ?? 0,
                'calcium_unit' => $foodData['totalNutrients']['CA']['unit'] ?? 0,
                'thiamin_unit' => $foodData['totalNutrients']['THIA']['unit'] ?? 0,
                'sodium_unit' => $foodData['totalNutrients']['NA']['unit'] ?? 0,
                'niacin_unit' => $foodData['totalNutrients']['NIA']['unit'] ?? 0,
                'folate_food' => $foodData['totalNutrients']['FOLFD']['quantity'] ?? null,
                'folate_dfe' => $foodData['totalNutrients']['FOLDFE']['quantity'] ?? null,
                'riboflavin' => $foodData['totalNutrients']['RIBF']['quantity'] ?? null,
                'sugar_unit' => $foodData['totalNutrients']['SUGAR']['unit'] ?? 0,
                'phosphorus' => $foodData['totalNutrients']['P']['quantity'] ?? null,
                'folic_unit' => $foodData['totalNutrients']['FOLAC']['unit'] ?? 0,
                'water_unit' => $foodData['totalNutrients']['WATER']['unit'] ?? 0,
                'fiber_unit' => $foodData['totalNutrients']['FIBTG']['unit'] ?? 0,
                'vitamin_k' => $foodData['totalNutrients']['VITK1']['quantity'] ?? null,
                'iron_unit' => $foodData['totalNutrients']['FE']['unit'] ?? 0,
                'magnesium' => $foodData['totalNutrients']['MG']['quantity'] ?? null,
                'zinc_unit' => $foodData['totalNutrients']['ZN']['unit'] ?? 0,
                'total_fat_unit' => $foodData['totalNutrients']['FAT']['unit'] ?? 0,
                'thiamin' => $foodData['totalNutrients']['THIA']['quantity'] ?? null,
                'niacin' => $foodData['totalNutrients']['NIA']['quantity'] ?? null,
                'folic' => $foodData['totalNutrients']['FOLAC']['quantity'] ?? null,
                'water' => $foodData['totalNutrients']['WATER']['quantity'] ?? null,
                'fiber' => $foodData['totalNutrients']['FIBTG']['quantity'] ?? null,
                'zinc' => $foodData['totalNutrients']['ZN']['quantity'] ?? null,
            ]);
}
 

     public function updateHealthLabels($storeFoodId,$foodDetails)
    {
        if (count($foodDetails['healthLabels'])) {
       //dd($storeFoodId,$foodDetails['healthLabels']);

            // if (request()->healthLabels) {

                $healthLabels = HealthLabel::all();
                     
                for ($i = 0; $i < count($foodDetails['healthLabels']); $i++) {

                    if ($healthLabels->where('value', $foodDetails['healthLabels'][$i])->pluck('id')->first() != null) {

                        $foodHealthLableArr[] = [
                            'food_id' => $storeFoodId,
                            'health_label_id' => $healthLabels->where('value',  $foodDetails['healthLabels'][$i])->pluck('id')->first(),
                            'created_at' => now(),
                        ];
                    }
                // }

            }
                \DB::table('food_health_label_maps')->insert($foodHealthLableArr);
        }
    }

public function foodHealthLabelMap(){
    return $this->hasMany(FoodHealthLabelMap::class);
}

}
