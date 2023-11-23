<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlanTemplateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_plan_template_tags', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('meal_plan_template_id');
            $table->unSignedBigInteger('health_complaint_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('meal_plan_template_id', 'meal_plan_template_tag_foreign')->references('id')->on('meal_plan_templates')->onDelete('CASCADE');
            $table->foreign('health_complaint_id', 'meal_plan_template_tag_id_foreign')->references('id')->on('health_complaints')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_plan_template_tags', function (Blueprint $table) {
            $table->dropForeign(['meal_plan_template_tag_foreign', 'meal_plan_template_tag_id_foreign']);
        });
    }
}
