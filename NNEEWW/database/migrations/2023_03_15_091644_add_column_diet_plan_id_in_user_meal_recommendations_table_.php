<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDietPlanIdInUserMealRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_meal_recommendations', function (Blueprint $table) {
            $table->unSignedBigInteger('diet_plan_id')->after('user_id')->nullable();
            $table->unSignedBigInteger('diet_id')->after('diet_plan_id')->nullable();

            $table->foreign('diet_plan_id')->references('id')->on('diet_plan_subscriptions')->onDelete('CASCADE');
            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_meal_recommendations', function (Blueprint $table) {
            $table->dropForeign(['user_meal_recommendations_diet_plan_id_foreign', 'user_meal_recommendations_diet_id_foreign']);
            $table->dropColumn(['diet_plan_id', 'diet_id']);
        });
    }
}
