<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTemplateIdInUserDailyDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->unSignedBigInteger('meal_plan_template_id')->after('diet_id')->nullable();

            $table->foreign('meal_plan_template_id', 'user_daily_meal_template_id_foreign')->references('id')->on('meal_plan_templates')->onDelete('CASCADE');
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
            
            $table->dropForeign(['user_daily_meal_template_id_foreign']);
            $table->dropColumn('meal_plan_template_id');
        });
    }
}
