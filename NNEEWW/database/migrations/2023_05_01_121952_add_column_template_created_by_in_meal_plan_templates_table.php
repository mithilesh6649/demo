<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTemplateCreatedByInMealPlanTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meal_plan_templates', function (Blueprint $table) {
            $table->unSignedBigInteger('template_created_by_id')->after('id')->nullable();
            $table->char('template_created_by_guard')->after('template_created_by_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_plan_templates', function (Blueprint $table) {
            
            $table->dropColumn(['template_created_by_id', 'template_created_by_guard']);
        });
    }
}
