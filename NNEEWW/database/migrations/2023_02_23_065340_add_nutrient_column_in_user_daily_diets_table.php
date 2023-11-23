<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNutrientColumnInUserDailyDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->float('total_fat_intake')->after('total_dinner_calorie_intake')->nullable();
            $table->float('total_carbs_intake')->after('total_fat_intake')->nullable();
            $table->float('total_protein_intake')->after('total_carbs_intake')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->dropColumn(['total_fat_intake', 'total_carbs_intake', 'total_protein_intake']);
        });
    }
}
