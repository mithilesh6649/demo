<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUserDailyDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->float('total_recommended_calorie')->after('meal_date')->nullable();
            $table->float('total_recommended_fat')->after('total_recommended_calorie')->nullable();
            $table->float('total_recommended_carbs')->after('total_recommended_fat')->nullable();
            $table->float('total_recommended_protein')->after('total_recommended_carbs')->nullable();
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
            $table->dropColumn(['total_recommended_calorie', 'total_recommended_fat', 'total_recommended_carbs', 'total_recommended_protein']);
        });
    }
}
