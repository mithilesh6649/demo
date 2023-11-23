<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnDatatypeInFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->decimal('calories', 10, 5)->change();
            $table->decimal('total_fat', 10, 5)->change();
            $table->decimal('saturated_fat', 10, 5)->change();
            $table->decimal('polyunsaturated_fat', 10, 5 )->change();
            $table->decimal('monounsaturated_fat', 10, 5)->change();
            $table->decimal('trans_fat', 10, 5)->change();
            $table->decimal('cholesterol', 10, 5)->change();
            $table->decimal('sodium', 10, 5)->change();
            $table->decimal('potassium', 10, 5)->change();
            $table->decimal('total_carbohydrate', 10, 5 )->change();
            $table->decimal('sugar', 10, 5)->change();
            $table->decimal('added_sugar', 10, 5)->change();
            $table->decimal('sugar_alcohol', 10, 5)->change();
            $table->decimal('protein', 10, 5)->change();
            $table->decimal('vitamin_a', 10, 5)->change();
            $table->decimal('vitamin_b_6', 10, 5 )->change();
            $table->decimal('vitamin_b_12', 10, 5)->change();
            $table->decimal('vitamin_c', 10, 5)->change();
            $table->decimal('vitamin_d', 10, 5)->change();
            $table->decimal('calcium', 10, 5)->change();
            $table->decimal('iron', 10, 5)->change();
            $table->decimal('dietary_fibre', 10, 5)->change();
            $table->decimal('magnesium', 10, 5)->change();
            $table->decimal('zinc', 10, 5)->change();
            $table->decimal('phosphorus', 10, 5)->change();
            $table->decimal('thiamin', 10, 5)->change();
            $table->decimal('riboflavin', 10, 5)->change();
            $table->decimal('niacin', 10, 5)->change();
            $table->decimal('folate_dfe', 10, 5)->change();
            $table->decimal('folate_food', 10, 5)->change();
            $table->decimal('folic', 10, 5)->change();
            $table->decimal('vitamin_k', 10, 5)->change();
            $table->decimal('water', 10, 5)->change();
            $table->decimal('fiber', 10, 5)->change();
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
            $table->float('calories')->change();
            $table->float('total_fat')->change();
            $table->float('saturated_fat')->change();
            $table->float('polyunsaturated_fat' )->change();
            $table->float('monounsaturated_fat')->change();
            $table->float('trans_fat')->change();
            $table->float('cholesterol')->change();
            $table->float('sodium')->change();
            $table->float('potassium')->change();
            $table->float('total_carbohydrate' )->change();
            $table->float('sugar')->change();
            $table->float('added_sugar')->change();
            $table->float('sugar_alcohol')->change();
            $table->float('protein')->change();
            $table->float('vitamin_a')->change();
            $table->float('vitamin_b_6' )->change();
            $table->float('vitamin_b_12')->change();
            $table->float('vitamin_c')->change();
            $table->float('vitamin_d')->change();
            $table->float('calcium')->change();
            $table->float('iron')->change();
            $table->float('dietary_fibre')->change();
            $table->float('magnesium')->change();
            $table->float('zinc')->change();
            $table->float('phosphorus')->change();
            $table->float('thiamin')->change();
            $table->float('riboflavin')->change();
            $table->float('niacin')->change();
            $table->float('folate_dfe')->change();
            $table->float('folate_food')->change();
            $table->float('folic')->change();
            $table->float('vitamin_k')->change();
            $table->float('water')->change();
            $table->float('fiber')->change();
        });
    }
}
