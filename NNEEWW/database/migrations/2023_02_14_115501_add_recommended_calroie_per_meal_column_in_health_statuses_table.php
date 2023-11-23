<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecommendedCalroiePerMealColumnInHealthStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->integer('recommended_breakfast_min_calorie_intake')->after('total_protein_per_day')->nullable();
            $table->integer('recommended_breakfast_max_calorie_intake')->after('recommended_breakfast_min_calorie_intake')->nullable();
            $table->integer('recommended_lunch_min_calorie_intake')->after('recommended_breakfast_max_calorie_intake')->nullable();
            $table->integer('recommended_lunch_max_calorie_intake')->after('recommended_lunch_min_calorie_intake')->nullable();
            $table->integer('recommended_snacks_min_calorie_intake')->after('recommended_lunch_max_calorie_intake')->nullable();
            $table->integer('recommended_snacks_max_calorie_intake')->after('recommended_snacks_min_calorie_intake')->nullable();
            $table->integer('recommended_dinner_min_calorie_intake')->after('recommended_snacks_max_calorie_intake')->nullable();
            $table->integer('recommended_dinner_max_calorie_intake')->after('recommended_dinner_min_calorie_intake')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->dropColumn(
                ['recommended_breakfast_min_calorie_intake', 
                'recommended_breakfast_max_calorie_intake', 
                'recommended_lunch_min_calorie_intake', 
                'recommended_lunch_max_calorie_intake',
                'recommended_snacks_min_calorie_intake',
                'recommended_snacks_max_calorie_intake',
                'recommended_dinner_min_calorie_intake',
                'recommended_dinner_max_calorie_intake'
            ]);
        });
    }
}
