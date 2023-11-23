<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->char('fat_unit')->after('total_fat')->nullable();
            $table->char('saturated_fat_unit')->after('saturated_fat')->nullable();
            $table->char('polyunsaturated_fat_unit')->after('polyunsaturated_fat')->nullable();
            $table->char('monounsaturated_fat_unit')->after('monounsaturated_fat')->nullable();
            $table->char('trans_fat_unit')->after('trans_fat')->nullable();
            $table->char('cholesterol_unit')->after('cholesterol')->nullable();
            $table->char('sodium_unit')->after('sodium')->nullable();
            $table->char('potassium_unit')->after('potassium')->nullable();
            $table->char('total_carbohydrate_unit')->after('total_carbohydrate')->nullable();
            $table->char('sugar_unit')->after('sugar')->nullable();
            $table->char('added_sugar_unit')->after('added_sugar')->nullable();
            $table->char('sugar_alcohol_unit')->after('sugar_alcohol')->nullable();
            $table->char('protein_unit')->after('protein')->nullable();
            $table->char('vitamin_a_unit')->after('vitamin_a')->nullable();
            $table->char('vitamin_b_6_unit')->after('vitamin_b_6')->nullable();
            $table->char('vitamin_b_12_unit')->after('vitamin_b_12')->nullable();
            $table->char('vitamin_c_unit')->after('vitamin_c')->nullable();
            $table->char('vitamin_d_unit')->after('vitamin_d')->nullable();
            $table->char('calcium_unit')->after('calcium')->nullable();
            $table->char('iron_unit')->after('iron')->nullable();
            $table->float('dietary_fibre')->after('iron_unit')->nullable();
            $table->char('dietary_fibre_unit')->after('dietary_fibre')->nullable();
            $table->float('magnesium')->after('dietary_fibre_unit')->nullable();
            $table->char('magnesium_unit')->after('magnesium')->nullable();
            $table->float('zinc')->after('magnesium_unit')->nullable();
            $table->char('zinc_unit')->after('zinc')->nullable();
            $table->float('phosphorus')->after('zinc_unit')->nullable();
            $table->char('phosphorus_unit')->after('phosphorus')->nullable();
            $table->float('thiamin')->after('phosphorus_unit')->nullable();
            $table->char('thiamin_unit')->after('thiamin')->nullable();
            $table->float('riboflavin')->after('thiamin_unit')->nullable();
            $table->char('riboflavin_unit')->after('riboflavin')->nullable();
            $table->float('niacin')->after('riboflavin_unit')->nullable();
            $table->char('niacin_unit')->after('riboflavin')->nullable();
            $table->float('folate_dfe')->after('niacin_unit')->nullable();
            $table->char('folate_dfe_unit')->after('folate_dfe')->nullable();
            $table->float('folate_food')->after('folate_dfe_unit')->nullable();
            $table->char('folate_food_unit')->after('folate_food')->nullable();
            $table->float('folic')->after('folate_food_unit')->nullable();
            $table->char('folic_unit')->after('folic')->nullable();
            $table->float('vitamin_k')->after('folic_unit')->nullable();
            $table->char('vitamin_k_unit')->after('vitamin_k')->nullable();
            $table->float('water')->after('vitamin_k_unit')->nullable();
            $table->char('water_unit')->after('water')->nullable();
            $table->float('fiber')->after('water_unit')->nullable();
            $table->char('fiber_unit')->after('fiber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn([
                'fat_unit',
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
            ]);
        });
    }
}
