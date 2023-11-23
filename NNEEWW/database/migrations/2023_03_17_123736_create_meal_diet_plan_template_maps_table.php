<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealDietPlanTemplateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_diet_plan_template_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('meal_plan_template_id');
            $table->smallInteger('day_number');
            $table->unSignedBigInteger('meal_type_id');
            $table->unSignedBigInteger('food_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('meal_plan_template_id', 'meal__diet_plan_template_id_foreign')->references('id')->on('meal_plan_templates')->onDelete('CASCADE');
            $table->foreign('meal_type_id', 'meal_diet_plan_type_id_foreign')->references('id')->on('md_dropdowns')->onDelete('CASCADE');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_diet_plan_template_maps', function (Blueprint $table) {

            $table->dropForeign(['meal__diet_plan_template_id_foreign', 'meal_diet_plan_type_id_foreign', 'meal_diet_plan_template_maps_food_id_foreign']);
        });
    }
}
